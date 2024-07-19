<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    public static function storeArticle($data)
    {
        try {
            // Crea un nuevo artículo con los datos proporcionados
            $article = self::create([
                'name' => $data['name'],
                'serial' => $data['serial'],
                'quantities' => $data['quantities'],
                'category_id' => $data['category_id'],
                'supplier_id' => $data['supplier_id'],
                'state' => 1
            ]);

            // Si el artículo se guarda correctamente, devuelve el objeto guardado
            return $article;

        } catch (\Exception $e) {
            return [
            'error' => true,
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];
        }
    }

}
