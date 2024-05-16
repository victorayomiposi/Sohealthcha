<?php

namespace App\Imports\candidate;

use App\Models\candidate\Candidate_info;
use App\Models\candidate\Candidate_result;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ApplicantImport implements ToCollection, WithHeadingRow
{
    protected $session;
    protected $failedRecords;

    public function __construct($session)
    {
        $this->session = $session;
        $this->failedRecords = new Collection();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $admissionNumber = $row['admissionnumber'];
            $score = $row['score'];

            $candidateInfo = Candidate_info::where('admissionnumber', $admissionNumber)
                ->where('session', $this->session)
                ->first();

            if ($candidateInfo) {
                Candidate_result::create([
                    'session' => $this->session,
                    'admissionnumber' => $admissionNumber,
                    'score' => $score,
                ]);
            } else {
                $this->failedRecords->push([
                    'admissionnumber' => $admissionNumber,
                    'message' => 'Admission Number ' . $admissionNumber . ' does not exist for the session ' . $this->session,
                ]);
            }
        }
    }

    public function getFailedRecords()
    {
        return $this->failedRecords;
    }
}
