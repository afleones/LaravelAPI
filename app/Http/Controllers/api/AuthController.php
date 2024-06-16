<?php   
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth; // Asegúrate de importar el alias correcto
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends Controller
{   
    public function login(Request $request)
    {
        // Definir mensajes de error en español
        $messages = [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];
    
        // Validar los campos requeridos con los mensajes personalizados
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);
    
        // Si la validación falla, devolver los errores en formato JSON
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()], 422);
        }
    
        // Intentar autenticar al usuario con JWTAuth
        $credentials = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales incorrectas, verifique sus datos e intentelo nuevamente'], 401);
        }
    
        // Obtener el usuario autenticado con su rol
        $user = Auth::user();
    
        // Obtener nombre del rol del usuario
        $roleName = $user->roles()->first(); // Suponiendo que la relación de roles está definida en el modelo User
    
        // Devolver la respuesta con el usuario, el nombre del rol y el token
        return response()->json([
            'message' => 'Bienvenido, usted ha iniciado sesión.',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'idRole' => $roleName->id,
                'roleName' => $roleName->name,
                'roleDescription' => $roleName->description,
            ],
            'token' => $token,
        ], 200);
    }    
    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response()->json(['token' => JWTAuth::refresh()]);
    }

    // Validar autenticacion de usuario logueado en el sistema
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
            }
        return response(['user' => $user], Response::HTTP_OK);
            
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'El campo nombre es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'El :attribute ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);
    
        if ($validator->fails()) {
            // Obtener todos los mensajes de error como un array
            $errors = $validator->errors()->all();
    
            // Devolver respuesta con los mensajes de error en un array
            return response()->json(['message' => $errors], 422);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        // Devolver respuesta de éxito
        return response()->json(['success' => 'Registro Exitoso, por favor inicie sesión.'], 201);
    }
}