<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cut_off extends Model
{
    use HasFactory;
    protected $table = 'cut_offs';
    protected $filable = ['name','type','cut_off'];

}  