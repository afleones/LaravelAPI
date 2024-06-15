<?php   
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;
use App\Models\User;
use JWTAuth;

class AuthController extends Controller
{   
    // Login
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
    
        // Obtener el usuario autenticado
        $user = JWTAuth::user();
    
        // Si deseas retornar todos los datos del usuario desde la base de datos
        // Descomenta la siguiente línea:
        //$user = User::find($user->id);
        return response(['user' => $user, 'token' => $token], Response::HTTP_OK);
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

    // Registro de Usuarios en el sistema
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create($data);

        $token = JWTAuth::fromUser($user);

        return response(['user' => $user, 'token' => $token], Response::HTTP_CREATED);
    }
}
