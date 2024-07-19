<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Supplier;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = ['name', 'serial', 'supplier', 'quantities', 'category_id', 'supplier_id', 'state', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    // Validacion de datos recibidos al crear un articulo en la base de datos
    public static function ValidateArticleData($data)
    {
        $errores = [];
    
        // Validar cada campo de los datos
        foreach ($data as $field => $valor) {
            switch ($field) {
                case 'name':
                case 'serial':
                    if (!is_string($valor) || strlen($valor) > 255) {
                        $errores[] = "El campo $field debe ser una cadena de caracteres con máximo 255 caracteres.";
                    }
                    break;
                case 'quantities':
                    if (!is_numeric($valor) || $valor < 0) {
                        $errores[] = "El campo $field debe ser un número entero positivo.";
                    }
                    break;
                case 'category_id':
                case 'supplier_id':
                    if (!is_numeric($valor) || $valor <= 0) {
                        $errores[] = "El campo $field debe ser un número entero positivo.";
                    }
                    break;
                case 'state':
                    if (!in_array($valor, [0, 1])) {
                        $errores[] = "El campo $field debe ser 0 o 1.";
                    }
                    break;
                default:
                    // No se realiza ninguna validación para otros campos
                    break;
            }
        }
    
        // Si hay mensajes de error, devolver el array de mensajes
        if (!empty($errores)) {
            return $errores;
        }
    
        // Si pasa todas las validaciones, retornar verdadero
        return true;
    }
    

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
