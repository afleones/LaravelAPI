<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;

class DesignsController extends Controller
{
    public function index(Request $request)
    {
        $designs = Design::all();

        return response()->json(['designs' => $designs], 200);
    }
}
