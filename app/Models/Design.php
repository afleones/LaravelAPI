<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $table = 'designs';

    protected $fillable = [
        'name',
        'state',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_design');
    }
}
