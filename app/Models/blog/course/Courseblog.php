<?php

namespace App\Models\blog\course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseblog extends Model
{
    use HasFactory;
    protected $table ='courseblogs';
    protected $fillable =['name','about','description','images'];
}
