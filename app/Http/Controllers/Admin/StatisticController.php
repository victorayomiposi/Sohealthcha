<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Department\Department;
use App\Models\candidate\Candidate_info;
use App\Models\candidate\Admissionshortlist;

class StatisticController extends Controller
{

    public function dashboardstat()
    {
        $year = Carbon::now()->format('Y');
        $admincount = User::count();
        $admittedcandidate = Admissionshortlist::where('session', $year)->count();
        $applicantcount = Candidate_info::where('session', $year)->count();
        $departmentcount = Department::count();
        return response()->json(compact('admincount', 'admittedcandidate', 'departmentcount', 'applicantcount', 'year'));
    }

    public function candidate_register_config()
    {
        $id = SiteConfig::where('code', 1)->pluck('id')->first();
        $configure = SiteConfig::find($id);
        return response()->json(compact('configure'));
    }
}
