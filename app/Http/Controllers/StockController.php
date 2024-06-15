<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class StockController extends Controller
{
    public function StoreArticle(Request $request)
    {
        $data = $request->all();

        
        $validates = Article::ValidateArticleData($data);

        if ($validates == true){
            $article = Article::StoreArticle($data);

            if ($article) {

                return response()->json(['Article' => $article], 201);
    
            } else {
                // Al menos una de las condiciones no es verdadera
                return response()->json(['message' => 'Error al registrar el despacho']);
            }
        } else {
            // Si alguna de las condiciones no se cumple, retornar el mensaje de error
            return response()->json(['Errors' => $$validates], 422);
        }

    }
}
