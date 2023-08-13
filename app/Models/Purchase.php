<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'supplier_id', 'quantity', 'discount_type', 'sale_price', 'total_price', 'paid_amount', 'due_amount'];

    public function onetoonerelationwithproducttable(){
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function onetoonerelationwithsuppliermoduletable(){
        return $this->hasOne('App\Models\Supplier', 'id', 'supplier_id');
    }
}
