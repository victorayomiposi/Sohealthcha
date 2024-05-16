<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_academic extends Model
{
    use HasFactory;
    protected $table = 'candidate_academic';
    protected $fillable = [
        'admissionnumber',
        'institution',
        'from',
        'to',
        'qualification',
        'session',
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
