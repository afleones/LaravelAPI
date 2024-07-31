<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';

    protected $fillable = [
        'name',
        'state',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_form');
    }
}
