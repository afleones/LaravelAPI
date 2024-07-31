<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';

    protected $fillable = [
        'name',
        'price',
        'state',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_size');
    }
}
