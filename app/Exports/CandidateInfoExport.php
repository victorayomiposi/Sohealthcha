<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\candidate\Candidate_info;

class CandidateInfoExport implements FromCollection, WithHeadings
{
    protected $session;

   public function __construct($session)
    {
        $this->session = $session;
    }


    public function collection()
    {
       return Candidate_info::where('session', $this->session)
    ->select('admissionnumber AS admission_number_1', 'admissionnumber AS admission_number_2', 'passport', 'surname', 'firstname', 'othername', 'session')
    ->get();

            }

    public function headings(): array
    {
        return [
            'Username',
            'Password',
            'Passport',
            'Surame',
            'Firstname',
            'Othername',
            'Session',
         ];
    }
}
