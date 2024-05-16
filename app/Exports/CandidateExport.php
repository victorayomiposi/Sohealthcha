<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Facades\Request;
use App\Models\candidate\Exam_checker;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidateExport implements FromQuery, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
{
    return Exam_checker::query()
        ->join('candidate_info', 'exam_checkers.admissionnumber', '=', 'candidate_info.admissionnumber')
        ->join('batches', 'exam_checkers.batch_id', '=', 'batches.id')
        ->select(
            'batches.name as Day',   
            'exam_checkers.time as Time',
            'exam_checkers.admissionnumber as Admission_Number',
            'candidate_info.surname as Surname',
            'candidate_info.firstname as Firstname',
            'candidate_info.othername as Othername',
            'candidate_info.gender as Gender',
            'candidate_info.session as Session',
             DB::raw("CONCAT('+', SUBSTRING(candidate_info.phone, 1, 3), ' ', SUBSTRING(candidate_info.phone, 4, 3), ' ', SUBSTRING(candidate_info.phone, 7)) as PhoneFormatted")
          )
        ->when(request('session'), function ($query, $session) {
            return $query->where('exam_checkers.session', $session);
        })
        ->when(request('batch'), function ($query, $batch) {
            return $query->where('exam_checkers.batch_id', $batch);
        })
        ->when(request('time'), function ($query, $time) {
            return $query->where('exam_checkers.time', $time);
        });
}
 public function headings(): array
    {
        return [
            'DAY',  
            'TIME',   
            'ADMISSION_NUMBER',   
            'SURNAME',   
            'FIRSTNAME',   
            'OTHERNAME',   
            'GENDER',   
            'SESSION',   
            'CONTACT',   
        ];
    }

}
