<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'purpose',
        'code',
        'amount',
        'phone',
        'time',
        'status',
        'authorizationUrl',
        'reference',
        'credoReference',
        'pinnumber',
        'serialnumber',
        'access_code',
    ];
}
