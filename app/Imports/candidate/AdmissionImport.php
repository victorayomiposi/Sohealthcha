<?php

namespace App\Imports\candidate;

use App\Models\candidate\Admissionshortlist;
use App\Models\candidate\Candidate_info;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class AdmissionImport implements ToCollection, WithHeadingRow
{
    protected $session;
    protected $coursename;
    protected $failedRecords;

    public function __construct($session, $coursename)
    {
        $this->session = $session;
        $this->coursename = $coursename;
        $this->failedRecords = new Collection();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $admissionNumber = $row['admissionnumber'];
 
            $candidateInfo = Candidate_info::where('admissionnumber', $admissionNumber)
                ->where('session', $this->session)
                ->first();

            if ($candidateInfo) {
                $existingResult = Admissionshortlist::where('admissionnumber', $admissionNumber)
                    ->where('session', $this->session)
                    ->where('coursename', $this->coursename)
                    ->first();

                if (!$existingResult) {
                    // Insert into candidate_result table
                    Admissionshortlist::create([
                        'session' => $this->session,
                        'coursename' => $this->coursename,
                        'admissionnumber' => $admissionNumber,
                        'count' => 1,
                    ]);

                    DB::table('resultchecker_admission_pin')->create([
                        'serial' => $this->generateUniqueSerial(),
                        'pin' => $this->generateUniquePin(),
                        'admissionnumber' => $admissionNumber,
                    ]);

                    DB::table('e_admission_pin')->create([
                        'serial' => $this->generateUniqueSerial(),
                        'pin' => $this->generateUniquePin(),
                        'admissionnumber' => $admissionNumber,
                    ]);
                } else {
                    $this->failedRecords->push([
                        'message' => 'Candidate result already exists for the session ' . $this->session,
                    ]);
                }
            } else {
                // Add to failed records collection
                $this->failedRecords->push([
                    'admissionnumber' => $admissionNumber,
                    'message' => 'Admission Number ' . $admissionNumber . ' does not exist in candidate_info for the session ' . $this->session,
                ]);
            }
        }
    }

    public function getFailedRecords()
    {
        return $this->failedRecords;
    }

    public function generateUniquePin()
    {
        do {
            $code = random_int(10000000000, 99999999999);
        } while (DB::table('resultchecker_admission_pin')->where("pin", "=", $code)->first());

        return $code;
    }

    public function generateUniqueSerial()
    {
        do {
            $code = random_int(100000000000, 999999999999);
        } while (DB::table('resultchecker_admission_pin')->where("serial", "=", $code)->first());

        return $code;
    }
}
