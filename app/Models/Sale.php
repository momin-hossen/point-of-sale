<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'customer_id', 'quantity', 'discount_type', 'sale_price', 'total_bill', 'paid_amount', 'due_amount'];

    public function onetoonerelationwithproducttable(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function onetoonerelationwithcustomertable(){
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
}
