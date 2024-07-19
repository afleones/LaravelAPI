<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SalesController extends Controller
{
    public function RegisterSale(Request $request)
    {
        $data = $request->all();

        $sale = Sale::RegisterSale($data);

        if ($sale){
            return response()->json(['Sale'=> $sale], 201);
        }
        return response()->json(['no es posible registrar su compra'], 422);
    }
}
