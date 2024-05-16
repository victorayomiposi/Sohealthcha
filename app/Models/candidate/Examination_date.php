<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination_date extends Model
{
    use HasFactory;
    protected $table = 'examination_date';
    protected $fillable = [
        'exam_date',
        'session',
    ];
}
