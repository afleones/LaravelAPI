<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeOfDocumentIdentification;

class TypesOfDocumentsIdentificationsController extends Controller
{
    public function index(Request $request)
    {
        $TypeOfDocumentsIdentification = TypeOfDocumentIdentification::all();

        return response()->json(['TyopeOfDocumentsIdentification' => $TypeOfDocumentsIdentification], 200);
    }
}
