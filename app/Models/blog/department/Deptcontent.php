<?php

namespace App\Models\blog\department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deptcontent extends Model
{
    use HasFactory;
    protected $table = 'deptcontents';
    protected $fillable = [
        'depart_id','title','description','date',
    ];

    public function deptblog()
    {
        return $this->belongsTo(Deptblog::class);
    }

    
}
