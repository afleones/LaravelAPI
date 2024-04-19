<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';  // Especifica el nombre de la tabla

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'city', 'campus', 'coach'
    ];


}
