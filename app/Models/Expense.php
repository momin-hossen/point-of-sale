<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = ['description', 'amount', 'expense_date', 'user_id', 'expense_category_id'];
    protected $dates = ['expense_date', 'deleted_at'];

    public function onetoonerelationwithexpensecategorytable(){
        return $this->hasOne('App\Models\ExpenseCategory', 'id', 'expense_category_id');
    }
}
