<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_olevel extends Model
{
    protected $table = 'candidate_olevel';
    use HasFactory;
    protected $fillable = [
        'admissionnumber',
        'entry_type',
        'utme_exam_no',
        'aggregate_score',
        'examboard',
        'examnumber',
        'subject_1',
        'grade_1',
        'subject_2',
        'grade_2',
        'subject_3',
        'grade_3',
        'subject_4',
        'grade_4',
        'subject_5',
        'grade_5',
        'subject_6',
        'grade_6',
        'session',
        'total',
    ];
    
    public function candidateInfo()
    {
        return $this->belongsTo(Candidate_info::class, 'admissionnumber', 'admissionnumber');
    }
    public function Admission()
    {
        return $this->belongsTo(Admissionshortlist::class, 'admissionnumber', 'admissionnumber');
    }
}
