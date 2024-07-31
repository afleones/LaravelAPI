<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryArticle extends Model
{
    use HasFactory;

    protected $table = 'categories_articles';

    protected $fillable = [
        'id_category',
        'id_article',
        'state',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article');
    }
}
