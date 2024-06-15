<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'serial', 'supplier', 'quantities', 'category_id', 'supplier_id', 'state'];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    public static function storeArticle($data)
    {
        // Crea un nuevo artículo con los datos proporcionados
        return self::create([
            'name' => $data['name'],
            'serial' => $data['serial'],
            'supplier' => $data['supplier'],
            'quantities' => $data['quantities'],
            'category_id' => $data['category_id'],
            'supplier_id' => $data['supplier_id'],
            'state' => $data['state'],
        ]);
    }
}
