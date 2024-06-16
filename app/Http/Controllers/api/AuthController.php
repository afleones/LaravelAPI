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
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $cookie = cookie('authToken', $token, 60*24);

        return response()->json(['user'=> $user,'token' => $token], 200)->withoutCookie($cookie);
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
        // Definir reglas de validación sin mensajes personalizados
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];

        // Validar los datos con las reglas definidas
        $validator = Validator::make($request->all(), $rules);

        // Manejar los errores de validación
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Lógica para registrar el usuario si la validación pasa

        return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
    }}