<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_result extends Model
{
    use HasFactory;
    protected $table ='candidate_result';
    protected $fillable = [
        'result_id','admissionnumber','session','score','resulttype',
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
