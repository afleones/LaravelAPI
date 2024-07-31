<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addition;

class AdditionsController extends Controller
{
    public function index(Request $request)
    {
        $additions = Addition::all();

        return response()->json(['additions' => $additions], 200);
    }
}
