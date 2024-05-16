<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'phone',
        'access_code',
        'address',
        'session',
        'business_name',
        'email',
        'date_registered',
    ];
}
