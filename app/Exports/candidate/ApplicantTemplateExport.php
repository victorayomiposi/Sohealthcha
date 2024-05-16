<?php

namespace App\Exports\candidate;

use App\Models\candidate\Candidate_info;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ApplicantTemplateExport implements FromCollection, WithHeadings
{
    protected $selectedSession;

    public function __construct($selectedSession)
    {
        $this->selectedSession = $selectedSession;
    }

    public function collection()
    {
        $admissionNumbers = DB::table('candidate_info')->where('session', $this->selectedSession)
            ->pluck('admissionnumber');
        $data = $admissionNumbers->map(function ($admissionNumber) {
            return [
                'admissionnumber' => $admissionNumber,
                'score' => '',
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'admissionnumber',
            'score',
        ];
    }
 
}
