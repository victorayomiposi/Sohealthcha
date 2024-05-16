<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purpose',
        'email',
        'amount',
        'phone',
        'time',
        'status',
        'description',
        'code',
        'fullname',
        'department',
        'admissionnumber',
        'session',
        'authorizationUrl',
        'reference',
        'credoReference',
    ];
}
