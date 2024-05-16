<?php

namespace App\Models\Department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SelectCourse extends Model
{
    use HasFactory;
    protected $table = 'course_selection';
    public function users()
    {
        return $this->hasMany(User::class, 'depertment_id', 'id');
    }
}
