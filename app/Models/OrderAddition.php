<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddition extends Model
{
    use HasFactory;

    protected $table = 'orders_additions';

    protected $fillable = [
        'id_addition',
        'id_order',
        'quantity',
        'state',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function addition()
    {
        return $this->belongsTo(Addition::class, 'id_addition');
    }
}
