<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    use HasFactory;

    protected $table = 'additions';

    protected $fillable = [
        'name',
        'description',
        'price',
        'state',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_additions', 'id_addition', 'id_order')
                    ->withPivot('quantity');
    }
    
}
