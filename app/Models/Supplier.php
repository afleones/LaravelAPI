<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function articles()
    {
        return $this->hasMany(Article::class, 'supplier_id', 'id');
    }

}
