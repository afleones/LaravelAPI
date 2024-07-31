<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Relación con el modelo CategorieArticle
    public function categoryArticles()
    {
        return $this->hasMany(CategorieArticle::class, 'id_category');
    }

    // Relación con el modelo Article a través de CategorieArticle
    public function articles()
    {
        return $this->hasManyThrough(Article::class, CategorieArticle::class, 'id_category', 'id', 'id', 'id_article');
    }
}
