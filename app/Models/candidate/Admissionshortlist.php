<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admissionshortlist extends Model
{
    use HasFactory;
    protected $table = 'admissionshortlist';
    protected $fillable = [
        'coursename',
        'admissionnumber',
        'count',
        'session',
    ];
 	

 
    
    
    public function candidateInfo()
    {
        return $this->belongsTo(Candidate_info::class, 'admissionnumber', 'admissionnumber');
    }
    public function candidateInstitution()
    {
        return $this->hasOne(Candidate_institution::class, 'admissionnumber', 'admissionnumber');
    }

    public function candidate()
    {
        return $this->hasOne(Candidate_info::class, 'admissionnumber', 'admissionnumber');
    }
    public function candidateAcademic()
    {
        return $this->hasOne(Candidate_academic::class, 'admissionnumber', 'admissionnumber');
    }

    public function admissionPin()
    {
        return $this->hasOne(Admission_pin::class, 'admissionnumber', 'admissionnumber');
    }

    public function candidateOlevel()
    {
        return $this->hasOne(Candidate_olevel::class, 'admissionnumber', 'admissionnumber');
    }

    public function examChecker()
    {
        return $this->hasOne(Exam_checker::class, 'admissionnumber', 'admissionnumber');
    }

    public function candidateresult()
    {
        return $this->hasOne(Candidate_result::class, 'admissionnumber', 'admissionnumber');
    }

}
