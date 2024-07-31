<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id_category_article',
        'id_user',
        'id_size',
        'id_flavor',
        'id_form',
        'id_filling',
        'id_design',
        'subtotal_order',
        'total_tax',
        'total_discount',
        'total_order',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function categoryArticle()
    {
        return $this->belongsTo(CategoryArticle::class, 'id_category_article');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'id_size');
    }

    public function flavor()
    {
        return $this->belongsTo(Flavor::class, 'id_flavor');
    }

    public function form()
    {
        return $this->belongsTo(Form::class, 'id_form');
    }

    public function filling()
    {
        return $this->belongsTo(Filling::class, 'id_filling');
    }

    public function design()
    {
        return $this->belongsTo(Design::class, 'id_design');
    }

    public function orderAdditions()
    {
        return $this->hasMany(OrderAddition::class, 'id_order');
    }

    public function additions()
    {
        return $this->belongsToMany(Addition::class, 'orders_additions', 'id_order', 'id_addition')
                    ->withPivot('quantity');
    }
}
