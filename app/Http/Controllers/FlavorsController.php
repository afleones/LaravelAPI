<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flavor;

class FlavorsController extends Controller
{
    public function index(Request $request)
    {
        $flavors = Flavor::all();

        return response()->json(['flavors' => $flavors], 200);
    }
}
