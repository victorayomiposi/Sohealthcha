<?php

namespace App\Models\candidate;

use App\Models\pin\PinStore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate_info extends Model
{
    protected $table = 'candidate_info';
    use HasFactory;
    protected $fillable = [
        'access_code',
        'regnum_digit',
        'passport',
        'surname',
        'admissionnumber',
        'firstname',
        'othername',
        'dateofbirth',
        'gender',
        'address',
        'phone',
        'email',
        'city',
        'localgovtorigin',
        'country',
        'stateoforigin',
        'maritalstatus',
        'placeofbirth',
        'kinsurname',
        'kinfirstname',
        'kinsothername',
        'session',
        'kinsphone',
        'entrytype',
        'kinsaddress',
        'password',
    ];
    public function Admission()
    {
        return $this->belongsTo(Admissionshortlist::class, 'admissionnumber', 'admissionnumber');
    }

    public function Pinstore()
    {
        return $this->belongsTo(PinStore::class, 'admissionnumber', 'admissionnumber');
    }

    public function candidateInstitution()
    {
        return $this->hasOne(Candidate_institution::class, 'admissionnumber', 'admissionnumber');
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

    public function Admissionlist()
    {
        return $this->hasOne(Admissionshortlist::class, 'admissionnumber', 'admissionnumber');
    }
}
