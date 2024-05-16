<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_checker extends Model
{
    use HasFactory;
    protected $table = 'exam_checkers';
    protected $fillable =['admissionnumber','batch_id','time','session'];

    public function candidateInfo()
    {
        return $this->hasOne(Candidate_info::class, 'admissionnumber', 'admissionnumber');
    }
 public function batch()
{
    return $this->belongsTo(Batch::class, 'batch_id');
}



    public function Admission()
    {
        return $this->hasOne(Admissionshortlist::class, 'admissionnumber', 'admissionnumber');
    }
}
