<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormsController extends Controller
{
    public function index(Request $request)
    {
        $forms = Form::all();

        return response()->json(['forms' => $forms], 200);
    }
}
