<?php

namespace App\Models\blog\department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deptblog extends Model
{
    use HasFactory;
    protected $table='deptblogs';
    protected $fillable =['name','about','description'];

    public function deptcontent()
    {
        return $this->hasMany(Deptcontent::class);
    }
}
