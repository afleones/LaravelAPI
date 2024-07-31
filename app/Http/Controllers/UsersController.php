<?php   
namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Role;
use App\Models\Customer; 

class UsersController extends Controller
{   
    public function users()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);

    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'type_document_id' => 'required|exists:type_documents_identifications,id',
            'identification_number' => 'required|numeric|unique:users,identification_number',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:191',
            'phone' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtener los datos validados
        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']); // Hashear la contraseña

        // Iniciar transacción
        DB::transaction(function () use ($data, &$user) {
            // Paso 1: Crear el Usuario
            $user = User::create([
                'name' => $data['name'],
                'type_document_id' => $data['type_document_id'],
                'identification_number' => $data['identification_number'],
                'email' => $data['email'],
                'password' => $data['password'],
                'state' => 1, // Estado activo
            ]);

            // Paso 2: Insertar el rol por defecto en roles_users (supongamos que el ID del rol por defecto es 2)
            DB::table('roles_users')->insert([
                'role_id' => 2,
                'user_id' => $user->id,
                'state' => 1, // Estado activo
            ]);

            // Paso 3: Crear el Cliente
            DB::table('customers')->insert([
                'user_id' => $user->id,
                'name' => $data['name'],
                'address' => $data['address'],
                'type_document_id' => $data['type_document_id'],
                'identification_number' => $data['identification_number'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        });

        // Recuperar el usuario con sus datos
        $user = User::with('roles')->find($user->id);
        $customer = Customer::where('user_id', $user->id)->first();

        // Formatear la respuesta
        $response = [
            'message' => 'Usuario creado exitosamente',
            'user' => $user,
            'customer' => $customer,
            'roles' => $user->roles->map(function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'description' => $role->description,
                    'state' => $role->state,
                ];
            }),
        ];

        return response()->json($response, 201);
    }
}