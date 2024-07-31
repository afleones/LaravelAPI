<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddition;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del request
        $validated = $request->validate([
            'id_category_article' => 'required|exists:categories_articles,id',
            'id_user' => 'required|exists:users,id',
            'id_size' => 'nullable|exists:sizes,id',
            'id_flavor' => 'nullable|exists:flavors,id',
            'id_form' => 'nullable|exists:forms,id',
            'id_filling' => 'nullable|exists:fillings,id',
            'id_design' => 'nullable|exists:designs,id',
            'additions' => 'array',
            'additions.*.id_addition' => 'required|exists:additions,id',
            'additions.*.quantity' => 'required|integer|min:1',
            'subtotal_order' => 'required|numeric',
            'total_tax' => 'nullable|numeric',
            'total_discount' => 'nullable|numeric',
            'total_order' => 'required|numeric',
            'state' => 'boolean',
        ]);

        // Iniciar una transacción
        DB::beginTransaction();
        
        try {
            // Crear el pedido
            $order = Order::create([
                'id_category_article' => $validated['id_category_article'],
                'id_user' => $validated['id_user'],
                'id_size' => $validated['id_size'],
                'id_flavor' => $validated['id_flavor'],
                'id_form' => $validated['id_form'],
                'id_filling' => $validated['id_filling'],
                'id_design' => $validated['id_design'],
                'subtotal_order' => $validated['subtotal_order'],
                'total_tax' => $validated['total_tax'],
                'total_discount' => $validated['total_discount'],
                'total_order' => $validated['total_order'],
                'state' => $validated['state'],
            ]);

            // Procesar adiciones
            $additions = $validated['additions'];
            foreach ($additions as $addition) {
                OrderAddition::create([
                    'id_addition' => $addition['id_addition'],
                    'id_order' => $order->id, // Aquí se utiliza el ID del pedido recién creado
                    'quantity' => $addition['quantity'],
                    'state' => true, // o lo que necesites para el estado
                ]);
            }

            // Confirmar transacción
            DB::commit();

            return response()->json(['message' => 'Order created successfully'], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturar errores específicos de la base de datos
            DB::rollBack();
            return response()->json(['error' => 'Database query error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Capturar errores generales
            DB::rollBack();
            return response()->json(['error' => 'Failed to create order', 'message' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        // Paso 1: Consultar todas las Órdenes desde la Vista orders_view
        $orders = DB::table('orders_view')->get();
        
        // Paso 2: Consultar todas las Adiciones desde la Vista additions_view
        // Primero, obtenemos todos los IDs de órdenes
        $orderIds = $orders->pluck('id');
        
        // Luego, obtenemos las adiciones correspondientes con totalAddition
        $additions = DB::table('additions_view')
                        ->whereIn('id_order', $orderIds)
                        ->get()
                        ->map(function ($addition) {
                            // Calcula el totalAddition
                            $addition->totalAddition = $addition->price * $addition->quantity;
                            return $addition;
                        });
        
        // Paso 3: Agrupar las adiciones por ID de orden
        $additionsGrouped = $additions->groupBy('id_order');
        
        // Paso 4: Agregar las adiciones a cada orden y calcular subtotal_order y total_order
        $ordersWithAdditions = $orders->map(function ($order) use ($additionsGrouped) {
            // Obtén las adiciones para la orden actual
            $orderAdditions = isset($additionsGrouped[$order->id]) 
                ? $additionsGrouped[$order->id] 
                : [];
            
            // Calcula el totalAddition como la suma de todas las adiciones
            $totalAddition = $orderAdditions->sum('totalAddition');
            
            // Calcula subtotal_order
            $subtotalOrder = $order->price_size + $order->total_tax + $totalAddition;
            
            // Calcula total_order
            $totalOrder = $subtotalOrder - $order->total_discount;
            
            // Agrega las adiciones a la orden
            $order->additions = $orderAdditions;
            $order->subtotal_order = $subtotalOrder;
            $order->total_order = $totalOrder;
            
            return $order;
        });
    
        return response()->json($ordersWithAdditions);
    }
                        
    public function show(Request $request)
    {
        $data = $request->all();
        $id_user = $data['id_user'];
        
        // Paso 1: Consultar todas las Órdenes desde la Vista orders_view
        $orders = DB::table('orders_view')
            ->where('id_user', $id_user)
            ->get();
        
        if ($orders->isEmpty()) {
            return response()->json(['error' => 'Usuario no tiene órdenes'], 404);
        }
        
        // Paso 2: Consultar todas las Adiciones desde additions_view
        $orderIds = $orders->pluck('id');
        $orderAdditions = DB::table('additions_view')
            ->whereIn('id_order', $orderIds)
            ->get()
            ->map(function ($addition) {
                // Calcula el totalAddition
                $addition->totalAddition = $addition->price * $addition->quantity;
                return $addition;
            });
        
        // Agrupa las adiciones por id_order
        $additionsGrouped = $orderAdditions->groupBy('id_order');
        
        // Paso 3: Formatear los Datos de las Órdenes
        $ordersWithAdditions = $orders->map(function ($order) use ($additionsGrouped) {
            // Obtén las adiciones para la orden actual
            $orderAdditions = isset($additionsGrouped[$order->id]) ? $additionsGrouped[$order->id] : [];
            
            // Calcula el totalAddition como la suma de todas las adiciones
            $totalAddition = $orderAdditions->sum('totalAddition');
            
            // Calcula subtotal_order
            $subtotalOrder = $order->price_size + $order->total_tax + $totalAddition;
            
            // Calcula total_order
            $totalOrder = $subtotalOrder - $order->total_discount;
            
            // Formatea la orden
            return [
                'order_id' => $order->id,
                'customer_name' => $order->customer_name,
                'type_document_id' => $order->type_document_id,
                'identification_number' => $order->identification_number,
                'email' => $order->email,
                'phone' => $order->phone,
                'address' => $order->address,
                'id_category' => $order->id_category,
                'category_name' => $order->category_name,
                'article_id' => $order->article_id,
                'article_name' => $order->article_name,
                'id_size' => $order->id_size,
                'size_name' => $order->size_name,
                'price_size' => $order->price_size,
                'id_flavor' => $order->id_flavor,
                'flavor_name' => $order->flavor_name,
                'id_form' => $order->id_form,
                'form_name' => $order->form_name,
                'id_filling' => $order->id_filling,
                'filling_name' => $order->filling_name,
                'id_design' => $order->id_design,
                'design_name' => $order->design_name,
                'subtotal_order' => $subtotalOrder,
                'total_tax' => $order->total_tax,
                'total_discount' => $order->total_discount,
                'total_order' => $totalOrder,
                'state' => $order->state,
                'additions' => $orderAdditions->where('id_order', $order->id)->map(function ($orderAddition) {
                    return [
                        'id' => $orderAddition->id,
                        'id_addition' => $orderAddition->id_addition,
                        'addition_name' => $orderAddition->name,
                        'addition_price' => $orderAddition->price,
                        'quantity' => $orderAddition->quantity,
                        'totalAddition' => $orderAddition->totalAddition
                    ];
                })->all()
            ];
        });
        
        return response()->json($ordersWithAdditions);
    }
}
