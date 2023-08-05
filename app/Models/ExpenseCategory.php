<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = ['name', 'status', 'description'];
    use HasFactory;

    public function onetomanyrelationwithexpensetable() {
        return $this->hasMany('App\Models\Expense', 'expense_category_id', 'id');
    }
}
