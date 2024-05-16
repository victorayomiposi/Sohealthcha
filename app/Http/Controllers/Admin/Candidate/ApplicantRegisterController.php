<?php

namespace App\Http\Controllers\Admin\Candidate;

use Carbon\Carbon;
use App\Models\Lga;
use App\Models\State;
use App\Models\SiteConfig;
use App\Models\pin\PinStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Models\candidate\Admission_pin;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Candidate_olevel;
use App\Models\candidate\Candidate_academic;
use App\Models\candidate\Candidate_institution;

class ApplicantRegisterController extends Controller
{
    public function authenticate()
    {
        return view('admin.candidate.auth.authenticate');
    }

    public function checkauthenticate(Request $request)
    {
        $request->validate([
            'pin' => 'required|exists:pinstore,pinnumber',
            'serial' => 'required|exists:pinstore,serialnumber',
        ]);
        $user_id = Auth::user()->id;
        $expire_at_date = SiteConfig::where('id', 6)->pluck('price')->first();

        $current_date = Carbon::now();
        if ($expire_at_date && $current_date->gt($expire_at_date)) {
            return redirect()->back()->with('error', 'Your pin and serial have expired. Please contact the administrator for assistance.');
        }


        $pinexist =  PinStore::where('pinnumber', $request->pin)->where('serialnumber', $request->serial)->first();
        if ($pinexist) {
            if ($pinexist->admissionnumber != 0) {
                return redirect()->back()->with('error', 'Your pin and serial have been taken');
            }
            PinStore::where('pinnumber', $request->pin)
                ->where('serialnumber', $request->serial)
                ->update(['user_id' => $user_id]);
            return redirect()->route('admin.candidate.auth.register', ['id' => $pinexist->id])->with('error', 'Authenticate successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid Pin And Serial Number Combination');
        }
    }

    public function registerapplicant($id)
    {
        $user_id = Auth::user()->id;
        $pin =  PinStore::where('id', $id)->where('user_id', $user_id)->where('admissionnumber', 0)->first();
        if ($pin) {
            $pinnumber =  $pin->pinnumber;
            $serialnumber =  $pin->serialnumber;
            $states = State::all();
            $departments = DB::table('course_selection')->get();
            return  view('auth.online.candidate.auth.register', compact('id', 'pinnumber', 'serialnumber', 'states', 'departments'));
        } else {
            return redirect()->route('dashboard')->with('error', 'Your pin and serial have been taken');
        }
    }

    public function storeapplicant(Request $request)
    {
        $id = $request->id;
        $pin =  PinStore::findorfail($id);
        $stateId =  State::where('name', $request->stateoforigin)->pluck('id')->first();
        $localgovtorigin =  Lga::where('name', $request->localgovtorigin)->pluck('id')->first();
        $pinStoreExists =
            PinStore::where('id', $id)
            ->where('serialnumber', $pin->serialnumber)
            ->where('pinnumber', $pin->pinnumber)
            ->where('admissionnumber', 0)
            ->first();
        $passportPath = null;
        if ($pinStoreExists) {
            $date = Carbon::now()->year;
            if ($request->hasFile('passport')) {
                $passport = $request->file('passport');
                $lastID = Candidate_info::where('session', $date)
                    ->where('stateoforigin', $request->stateoforigin)
                    ->where('localgovtorigin', $request->localgovtorigin)
                    ->orderByDesc('regnum_digit')
                    ->orderByDesc('created_at')
                    ->orderByDesc('id')
                    ->first();

                $last_id_value = $lastID !== null ? (int) $lastID->regnum_digit + 1 : 1;
                $school_lga_id = $stateId;
                $admissionNumber = str_pad($school_lga_id, 2, "0", STR_PAD_LEFT) . substr($date, 2, 2) . str_pad($localgovtorigin, 3, "0", STR_PAD_LEFT) . str_pad($last_id_value, 3, "0", STR_PAD_LEFT);
                $fileName = $admissionNumber . '.' . $passport->getClientOriginalExtension();
                $passportPath = $passport->storeAs('passport_uploads', $fileName, 'public');
                $passportImage = Image::make(public_path('storage/' . $passportPath));
                $passportImage->fit(300, 300);
                $passportImage->save(public_path('storage/' . $passportPath));
            }
            DB::transaction(function () use ($request, $date, $passportPath, $admissionNumber, $pin) {
                $candidate = Candidate_info::create([
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
                    'password' => Hash::make('password'),
                ]);

                $newinstitution = Candidate_institution::create([
                    'admissionnumber' => $candidate->admissionnumber,
                    'firstchoiceschool' => $request->department,
                    'firstchoicecourse' => $request->course,
                    'session' => $candidate->session,
                    'dateadded' => Carbon::now(),
                ]);

                $user = PinStore::where('serialnumber', $pin->serialnumber)->first();

                if ($user) {
                    $updated = PinStore::where('serialnumber', $pin->serialnumber)
                        ->update(['admissionnumber' => $candidate->admissionnumber]);

                    if (!$updated) {
                        return redirect()->route('dashboard')->with('error', 'Not found');
                    }
                } else {
                    return redirect()->route('dashboard')->with('error', 'Not found');
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

            return redirect()->route('dashboard')->with('success', 'Candidate created successfully');
        } else {
            return redirect()->route('dashboard')->with('error', 'Your pin and serial have been taken');
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
