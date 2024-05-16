<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admission_pin extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $table = 'resultchecker_admission_pin';
    protected $fillable = [
        'admissionnumber',
        'serial',
        'pin',
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
