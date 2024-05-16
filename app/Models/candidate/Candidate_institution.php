<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_institution extends Model
{
    use HasFactory;
    protected $table = 'candidate_institution_choice';
    protected $fillable = [
        'admissionnumber',
        'firstchoiceschool',
        'firstchoicecourse',
        'session',
        'dateadded',
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
