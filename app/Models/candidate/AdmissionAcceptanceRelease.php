<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionAcceptanceRelease extends Model
{
        use HasFactory;

    protected $table ='admission_acceptance_release';
    protected $fillable = [
        'session',
        'locked',
    ];
}
