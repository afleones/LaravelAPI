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

    protected $fillable = [
        'name',
        'description',
        'price',
        'state',
    ];

   // Relación con el modelo CategorieArticle
   public function categoryArticles()
   {
       return $this->hasMany(CategorieArticle::class, 'id_article');
   }

   // Relación con el modelo Category a través de CategorieArticle
   public function categories()
   {
       return $this->hasManyThrough(Category::class, CategorieArticle::class, 'id_article', 'id', 'id', 'id_category');
   }

}
