<?php   
namespace App\Http\Controllers;

use App\Models\User;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Response;

class UserController extends Controller
{   
    public function users()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);

    }
}