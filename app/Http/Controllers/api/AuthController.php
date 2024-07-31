<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar campos
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()], 422);
        }
    
        // Intentar autenticar al usuario
        try {
            $credentials = $request->only('email', 'password');
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Credenciales incorrectas, verifique sus datos e intentelo nuevamente'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'No se pudo crear el token'], 500);
        }
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener nombre del rol del usuario si está definido
        $roleName = $user->roles()->first(); // Suponiendo que la relación de roles está definida en el modelo User
    
        // Configurar la cookie con el token JWT
        $cookie = cookie('jwt_token', $token, config('jwt.ttl')); // 'jwt_token' es el nombre de la cookie
    
        // Construir la respuesta con los datos del usuario y la cookie JWT
        $response = [
            'id' => $user->id,
            'email' => $user->email,
            'idRole' => optional($roleName)->id, // Usar optional para evitar errores si $roleName es null
            'roleName' => optional($roleName)->name,
            'roleDescription' => optional($roleName)->description,
        ];
    
        return response()->json([
            'message' => 'Bienvenido, usted ha iniciado sesión.', 'user' => $response, 'token'=>$token], 200)
            ->withCookie($cookie);
    }

   // Obtener usuario autenticado
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Cerrar sesión y eliminar token JWT
    public function logout()
    {
        Auth::logout();

        // Eliminar la cookie de sesión
        $cookie = new Cookie('jwt_token', '', time() - 3600); // Expira inmediatamente

        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

    // Registro de nuevos usuarios
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Añade :email para especificar el campo
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique' => 'El correo electrónico ingresado ya está en uso.', // Mensaje personalizado
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()], 422);
        }

        // Crear usuario utilizando el método estático del modelo User
        User::createUser($request->only('name', 'email', 'password'));

        return response()->json(['success' => 'Registro exitoso, por favor inicie sesión.'], 201);
    }
}

