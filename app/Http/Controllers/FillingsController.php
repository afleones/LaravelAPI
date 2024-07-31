<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filling;

class FillingsController extends Controller
{
    public function index(Request $request)
    {
        $fillings = Filling::all();

        return response()->json(['fillings' => $fillings], 200);
    }
}
