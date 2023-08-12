<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModule extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'address',
        'password',
        'total_bill',
        'due_amount',
        'paid_amount',
    ];

    use HasFactory;
}
