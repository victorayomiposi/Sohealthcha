<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentAssign extends Model
{
    use HasFactory;
      protected $fillable = [
        'payment_id',
        'department',
        'price',
        'category',
        'user_id',
    ];
}
