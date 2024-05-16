<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\School\House;
use Illuminate\Http\Request;
use App\Models\School\ArmName;
use App\Models\School\ClassName;
use App\Helpers\Query\GetResponse;
use App\Models\Payment;
use App\Models\PaymentAssign;
use App\Models\SiteConfig;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class JqueryController extends Controller
{
    public function getLGAs($stateId)
    {
        $state = State::where('name', $stateId)->pluck('id')->first();
        $lgas = Lga::where('state_id', $state)->get();
        return response()->json($lgas);
    }

    public function getDepartment($departmentId)
    {
        $departments = DB::table('course_selection')->where('schoolname', $departmentId)->get();
        return response()->json($departments);
    }

    public function getpayments($paymentId)
    {
        $payment = SiteConfig::find($paymentId);
        return response()->json($payment);
    }

    public function getpaymentsschool($paymentId)
    {
        $payment = PaymentAssign::find($paymentId);
        return response()->json($payment);
    }

    public function getpaymentsother($paymentId)
    {
        $payment = Payment::find($paymentId);
        return response()->json($payment);
    }
}
