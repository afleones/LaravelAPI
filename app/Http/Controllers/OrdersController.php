<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddition;
use App\Models\CategoryArticle;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del request, incluyendo la imagen
        $validated = $request->validate([
            'id_category_article' => 'required|exists:categories_articles,id',
            'id_user' => 'required|exists:users,id',
            'id_size' => 'nullable|exists:sizes,id',
            'id_flavor' => 'nullable|exists:flavors,id',
            'id_form' => 'nullable|exists:forms,id',
            'id_filling' => 'nullable|exists:fillings,id',
            'id_design' => 'nullable|exists:designs,id',
            'additions' => 'nullable|array', 
            'additions.*.id_addition' => 'required_with:additions|exists:additions,id', 
            'additions.*.quantity' => 'required_with:additions|integer|min:1',           
            'subtotal_order' => 'required|numeric',
            'total_tax' => 'nullable|numeric',
            'total_discount' => 'nullable|numeric',
            'total_order' => 'required|numeric',
            'state' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
        ]);
    
        // Iniciar una transacción
        DB::beginTransaction();
    
        try {
            // Crear el pedido
            $orderData = [
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
            ];
    
            // Verificar si hay una imagen y procesarla
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('images', 'public'); // Guarda la imagen en el directorio public/images
                $orderData['image'] = $imagePath; // Agrega la ruta de la imagen a los datos del pedido
            }
    
            $order = Order::create($orderData);
    
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
    
            // Guardar la información del archivo en la tabla `files` si se subió una imagen
            if ($imagePath) {
                File::create([
                    'id_order' => $order->id,
                    'path' => $imagePath,
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

    public function showOrder(Request $request)
    {
        $data = $request->all();
        $order_id = $data['order_id']; // ID de la orden que queremos buscar
        
        // Paso 1: Consultar la Orden desde la Vista orders_view según el ID de la orden
        $order = DB::table('orders_view')
            ->where('id', $order_id)
            ->first(); // Usa first() para obtener solo un registro
        
        if (!$order) {
            return response()->json(['error' => 'Orden no encontrada'], 404);
        }
        
        // Paso 2: Consultar todas las Adiciones desde additions_view para la orden específica
        $orderAdditions = DB::table('additions_view')
            ->where('id_order', $order_id)
            ->get()
            ->map(function ($addition) {
                // Calcula el totalAddition
                $addition->totalAddition = $addition->price * $addition->quantity;
                return $addition;
            });
        
        // Paso 3: Consultar archivos asociados a la orden específica
        $files = DB::table('files')
            ->where('id_order', $order_id)
            ->get();
        
        // Generar las URLs de las imágenes
        $filesWithUrls = $files->map(function ($file) {
            // Suponiendo que las imágenes están almacenadas en 'storage/app/public', la URL sería:
            $url = asset('storage/' . $file->path);
            return [
                'id' => $file->id,
                'path' => $file->path,
                'url' => $url, // URL completa de la imagen
            ];
        });

        // Calcula el totalAddition como la suma de todas las adiciones
        $totalAddition = $orderAdditions->sum('totalAddition');
        
        // Calcula subtotal_order
        $subtotalOrder = $order->price_size + $order->total_tax + $totalAddition;
        
        // Calcula total_order
        $totalOrder = $subtotalOrder - $order->total_discount;
        
        // Formatea la orden
        $orderWithDetails = [
            'order_id' => $order->id,
            'customer_name' => $order->customer_name,
            'type_document_id' => $order->type_document_id,
            'identification_number' => $order->identification_number,
            'email' => $order->email,
            'phone' => $order->phone,
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
            'additions' => $orderAdditions->map(function ($orderAddition) {
                return [
                    'id' => $orderAddition->id,
                    'id_addition' => $orderAddition->id_addition,
                    'addition_name' => $orderAddition->name,
                    'addition_price' => $orderAddition->price,
                    'quantity' => $orderAddition->quantity,
                    'totalAddition' => $orderAddition->totalAddition
                ];
            })->all(),
            'files' => $filesWithUrls // Incluye la URL de la imagen en la respuesta
        ];
        
        return response()->json($orderWithDetails);
    }

    public function showCategorieArticles(Request $request)
    {
        $results = DB::table('categories_articles as car')
            ->join('categories as cat', 'cat.id', '=', 'car.id_category')
            ->join('articles as art', 'art.id', '=', 'car.id_article')
            ->select(
            'car.id as id_category_article',
            'car.id_category',
            'cat.name as name_category',
            'car.id_article as id_article',
            'art.name as name_article'
        )->get();

        return response()->json(['CategoriesArticles' => $results]);
    }

}
