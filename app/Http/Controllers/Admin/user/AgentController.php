<?php

namespace App\Http\Controllers\Admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department\Department;
use Illuminate\Support\Facades\Hash;
use App\Models\Agent\Agent;
use Carbon\Carbon;
use App\Models\pin\PinStore;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function create()
    {
        $Department = Department::all();
        return view('admin.agent.create', compact('Department'));
    }

    public function view()
    {
        $Department = Agent::all();
        return view('admin.agent.view', compact('Department'));
    }

    public function edit($id)
    {
        $User = Agent::find($id);
         return view('admin.agent.edit', compact('User'));
    }

    public function destroy($id)
    {
        $user = DB::table('pinstore')->find($id);

        if ($user) {
            DB::table('pinstore')->where('id', $id)->delete();
            return back()->with('success', 'Pin and serial deleted successfully');
        }

        return back()->with('error', 'Pin and serial not found');
    }

    public function delete_course_pin($id)
    {
        $user = DB::table('changeofcourseformpin')->where('courseformID', $id)->get();

        if ($user) {
            DB::table('changeofcourseformpin')->where('courseformID', $id)->delete();
            return back()->with('success', 'Pin and serial deleted successfully');
        }

        return back()->with('error', 'Pin and serial not found');
    }
     

public function save_agent(Request $request)
{
    $todayDate = Carbon::now()->format('d-M-Y');
    $agentExist = Agent::where('business_name', $request->business_name)->first();

    if ($agentExist) {
        return back()->with('error', $request->business_name . ' already exists');
    }

    $user = Agent::create([
        'fullname' => $request->surname . ' ' . $request->firstname . ' ' . $request->middlename,
        'phone' => $request->phone,
        'access_code' => 'SOHELTCHA' . $this->generateUniqueAccess(),
        'address' => $request->address,
        'session' => $request->session,
        'business_name' => $request->business_name,
        'email' => $request->email,
        'date_registered' => $todayDate,
    ]);

    if ($user) {
        return back()->with('success', 'Agent created successfully');
    }

    return back()->with('error', 'An error occurred while creating the agent');
}

public function update_agent(Request $request, $id)
{
     $agent = Agent::findOrFail($id);    

    $agent->fullname = $request->surname . ' ' . $request->firstname . ' ' . $request->middlename;
    $agent->phone = $request->phone;
    $agent->address = $request->address;
    $agent->session = $request->session;
    $agent->business_name = $request->business_name;
    $agent->email = $request->email;
 
    if ($agent->save()) {
        return redirect()->route('view_agent')->with('success', 'Agent updated successfully');
    }

    return back()->with('error', 'An error occurred while updating the agent');
}

public function generateUniqueAccess()
{
    do {
        $code = random_int(10000, 99999);
    } while (Agent::where('access_code', $code)->exists());

    return $code;
}


public function delete($id)
{
    $user = Agent::findOrFail($id);

    if ($user->delete()) {
        return back()->with('success', 'Agent deleted successfully');
    }

    return back()->with('error', 'An error occurred while deleting the Agent');
}
 
}
