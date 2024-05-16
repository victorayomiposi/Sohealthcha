<?php

namespace App\Http\Controllers\pin;

use App\Http\Controllers\Controller;
use App\Models\candidate\Admission_pin;
use App\Models\candidate\ChangeOfCourseFormPin;
use Illuminate\Http\Request;
use App\Models\pin\PinStore;
use App\Models\EAdmissionPin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $usepin = $request->input('usepin');

        $existingPin = DB::table('pinstore')->where('status', 0)->orderBy('id', 'desc');
        if ($usepin == 1) {
            $existingPin->where('admissionnumber', '>', 0);
        } else {
            $existingPin->where('admissionnumber', '=', 0)->orWhereNull('admissionnumber');
        }

        $existingPin = $existingPin->paginate($perPage);
        return view('admin.pin.manual.create', compact('existingPin'));
    }

    public function printcandidatepin($per_page, $usepin)
    {

        $perPage = $per_page;

        $existingPin = DB::table('pinstore')->orderBy('id', 'desc');
        if ($usepin == 1) {
            $existingPin->where('admissionnumber', '>', 0);
        } else {
            $existingPin->where('admissionnumber', '=', 0)->orWhereNull('admissionnumber');
        }

        $existingPin = $existingPin->paginate($perPage);

        $pdf = Pdf::loadView(
            'pdf.candidate.pinprintout',
            compact('existingPin')
        )->setPaper('a4');

        return $pdf->stream('Candidate_pin_Amount_' . $perPage . '.pdf');
    }

    public function course(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $usepin = $request->input('usepin');
        $course = $request->input('course');

        $departments = DB::table('course_selection')->get();
        $existingPin = DB::table('changeofcourseformpin')->orderBy('courseformID', 'desc');

        if ($course) {
            $existingPin->where('course_available', $course);
        }

        if ($usepin == 1) {
            $existingPin->where('admissionnumber', '>', 0);
        } else {
            $existingPin->where('admissionnumber', '=', 0)->orWhereNull('admissionnumber');
        }

        $existingPin = $existingPin->paginate($perPage);

        return view('admin.pin.manual.add', compact('existingPin', 'departments'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'length' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $pins = PinStore::generateUniqueNumbers($validatedData['length'], $validatedData['amount']);

        return redirect()->route('add_pin')
            ->with('success', count($pins) . ' Pin & Serial numbers generated and saved.');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'length' => 'required|numeric',
            'amount' => 'required|numeric',
            'course' => 'required',
        ]);

        $pins = ChangeOfCourseFormPin::generateUniqueNumbers($validatedData['length'], $validatedData['amount'], $validatedData['course']);

        return redirect()->route('course_pin')->with('success', count($pins) . ' Pin & Serial numbers generated and saved for the course.');
    }


    public function admission(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $usepin = $request->input('usepin');

        $existingPin = DB::table('e_admission_pin')->orderBy('pinid', 'desc');



        if ($usepin == 1) {
            $existingPin->where('admissionnumber', '>', 0);
        } else {
            $existingPin->where('admissionnumber', '=', 0)->orWhereNull('admissionnumber');
        }

        $existingPin = $existingPin->paginate($perPage);

        return view('admin.pin.manual.addadmission', compact('existingPin'));
    }


    public function admissionpinsave(Request $request)
    {
        $validatedData = $request->validate([
            'length' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $pins = EAdmissionPin::generateUniqueNumbers($validatedData['length'], $validatedData['amount']);

        return redirect()->route('admission_pin')->with('success', count($pins) . ' Pin & Serial numbers generated and saved for the course.');
    }
}
