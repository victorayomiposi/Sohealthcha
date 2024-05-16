<?php

namespace App\Models\pin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinStore extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pinstore';
    
}
