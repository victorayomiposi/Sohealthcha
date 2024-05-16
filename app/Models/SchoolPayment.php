<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'purpose',
        'email',
        'amount',
        'code',
        'phone',
        'status',
        'fullname',
        'department',
        'admissionnumber',
        'session',
        'authorizationUrl',
        'reference',
        'credoReference',
    ];
}
