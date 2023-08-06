<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'price', 'image', 'discount_type', 'discount_amount', 'sale_price'];

    
    public function onetoonerelationwithcategorytable(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}