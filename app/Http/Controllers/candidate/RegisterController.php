<?php

namespace App\Http\Controllers\candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent\Agent;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Candidate_institution;
use App\Models\candidate\Candidate_academic;
use App\Models\candidate\Admission_pin;
use App\Models\candidate\Candidate_olevel;
use App\Models\pin\PinStore;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{

    public function index()
    {

        return view('auth.candidate.index');
    }

    public function check_user(Request $request)
    {
        $pinnumber = $request->input('pinnumber');
        $serialnumber = $request->input('serialnumber');
        $access_coded = $request->input('access_coded');

        $pinStoreExists = DB::table('pinstore')
            ->where('pinnumber', $pinnumber)
            ->where('serialnumber', $serialnumber)
            ->exists();

        $pinUsed = DB::table('pinstore')
            ->where('pinnumber', $pinnumber)
            ->where('serialnumber', $serialnumber)
            ->pluck('admissionnumber')
            ->first();

        $agentExists = Agent::where('access_code', $access_coded)->exists();

        if ($pinStoreExists && $agentExists) {
            if (empty($pinUsed)) {
                return redirect()->route('add', [
                    'pinnumber' => $pinnumber,
                    'serialnumber' => $serialnumber,
                    'access_coded' => $access_coded
                ]);
            } else {
                return redirect()->back()
                    ->with('error', 'The pin and serial number have already been used by admission number: ' . $pinUsed);
            }
        } else {
            // Data doesn't exist
            return redirect()->back()->with('error', 'Invalid Pin And Serial Number Combination.');
        }
    }
    public function add(Request $request, $pinnumber, $serialnumber, $access_coded)
    {

        $departments = DB::table('course_selection')->get();
        return view('auth.candidate.add', compact('pinnumber', 'serialnumber', 'access_coded', 'departments'));


        // Rest of the method logic
    }


    public function store(Request $request)
    {
         $pinStoreExists = DB::table('pinstore')
            ->where('serialnumber', $request->serialnumber)
            ->where('pinnumber', $request->pinnumber)
            ->first();
         $passportPath = null;

        if ($pinStoreExists->admissionnumber == 0) {
            $todayDate = Carbon::now()->format('d-M-Y');
            $date = Carbon::now()->year;

            

            if ($request->hasFile('passport')) {
                $passport = $request->file('passport');

                $admissionNumber = $this->generateUniqueCode() . '' . $date;

                $folderPath = './passport_uploads';

                // Store the original passport file
                $fileName = $admissionNumber . '.' . $passport->getClientOriginalExtension();
                $passportPath = $passport->storeAs('passport_uploads', $fileName, 'public');

                // Resize the passport image to a standard passport size
                $passportImage = Image::make(public_path('storage/' . $passportPath));
                $passportImage->fit(300, 300); // You can adjust the dimensions as needed
                $passportImage->save(public_path('storage/' . $passportPath));
            }
            DB::transaction(function () use ($request, $date, $passportPath, $admissionNumber) {
                $candidate = Candidate_info::create([
                    'access_code' => $request->access_coded,
                    'surname' => $request->surname,
                    'admissionnumber' => $admissionNumber,
                    'firstname' => $request->firstName,
                    'passport' => $passportPath,
                    'othername' => $request->lastName,
                    'dateofbirth' => $request->dateofbirth,
                    'gender' => $request->gender,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'city' => $request->city,
                    'localgovtorigin' => $request->localgovtorigin,
                    'country' => $request->country,
                    'stateoforigin' => $request->stateoforigin,
                    'maritalstatus' => $request->maritalstatus,
                    'placeofbirth' => $request->placeofbirth,
                    'kinsurname' => $request->kinsurname,
                    'kinfirstname' => $request->kinfirstname,
                    'kinsothername' => $request->kinsothername,
                    'session' => $date,
                    'kinsphone' => $request->kinsphone,
                    'entrytype' => $request->entrytype,
                    'password' => bcrypt('$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
                ]);

                $newinstitution = Candidate_institution::create([
                    'admissionnumber' => $candidate->admissionnumber,
                    'firstchoiceschool' => $request->department,
                    'firstchoicecourse' => $request->course,
                    'session' => $candidate->session,
                    'dateadded' => Carbon::now(),
                ]);

                $user = DB::table('pinstore')->where('serialnumber', $request->serialnumber)->first();

                if ($user) {
                    $updated = DB::table('pinstore')
                        ->where('serialnumber', $request->serialnumber)
                        ->update(['admissionnumber' => $candidate->admissionnumber]);

                    if (!$updated) {
                        return redirect()->route('user_authorization')->with('error', 'Not found');
                    }
                } else {
                    return redirect()->route('user_authorization')->with('error', 'Not found');
                }

                $academic = Candidate_academic::create([
                    'admissionnumber' => $candidate->admissionnumber,
                    'institution' => $request->institution,
                    'from' => $request->from,
                    'to' => $request->to,
                    'qualification' => $request->qualification,
                    'session' => $request->session,
                    'datecollected' => Carbon::now()->format('d-M-Y'),
                ]);

                $pin = Admission_pin::create([
                    'admissionnumber' => $candidate->admissionnumber,
                    'serial' => $this->generateUniquePin(),
                    'pin' => $this->generateUniqueSerial(),
                ]);

                $academicer = Candidate_olevel::create([
                    'admissionnumber' => $candidate->admissionnumber,
                    'entry_type' => $request->entry_type,
                    'utme_exam_no' => $request->utme_exam_no ?? 0,
                    'aggregate_score' => $request->aggregate_score ?? 0,
                    'examboard' => $request->examboard,
                    'examnumber' => $request->examnumber,
                    'subject_1' => $request->subject1,
                    'grade_1' => $request->grade1,
                    'subject_2' => $request->subject2,
                    'grade_2' => $request->grade2,
                    'subject_3' => $request->subject3,
                    'grade_3' => $request->grade3,
                    'subject_4' => $request->subject4,
                    'grade_4' => $request->grade4,
                    'subject_5' => $request->subject5,
                    'grade_5' => $request->grade5,
                    'subject_6' => $request->subject6,
                    'grade_6' => $request->grade6,
                    'session' => $academic->session,
                ]);
            });

            return redirect()->route('user_authorization')->with('success', 'Candidate created successfully');
        } else {
            return redirect()->route('user_authorization')->with('error', 'Your pin and serial have been taken');
        }
    }


    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (Candidate_info::where("admissionnumber", "=", $code)->first());

        return $code;
    }
    public function generateUniquePin()
    {
        do {
            $code = random_int(10000000000, 99999999999);
        } while (Admission_pin::where("pin", "=", $code)->first());

        return $code;
    }
    public function generateUniqueSerial()
    {
        do {
            $code = random_int(100000000000, 999999999999);
        } while (Admission_pin::where("serial", "=", $code)->first());

        return $code;
    }
}
