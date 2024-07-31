<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizesController extends Controller
{
    public function index(Request $request)
    {
        $sizes = Size::all();

        return response()->json(['sizes' => $sizes], 200);
    }
}
