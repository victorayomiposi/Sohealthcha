<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'allocation', 'description', 'session'];

    public function times()
    {
        return $this->hasMany(Time::class, 'batch_id');
    }
   public function examCheckers()
{
    return $this->hasMany(Exam_checker::class, 'batch_id');
}

}
