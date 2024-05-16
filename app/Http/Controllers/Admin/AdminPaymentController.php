<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Department\SelectCourse;
use App\Models\PaymentAssign;

class AdminPaymentController extends Controller
{
    public function paymentsetting()
    {
        $paymentsettings = Payment::all();
        return view('admin.setting.paymentsetting', compact('paymentsettings'));
    }

    public function paymentassign(Request $request)
    {
        $paymentType = $request->input('payment_type');
        $category = $request->input('category');

        $query = PaymentAssign::query();
    
        if ($paymentType) {
            $query->where('payment_id', $paymentType);
        }    
        if ($category) {
            $query->where('category', $category);
        }  
        $paymentSettings = $query->get();
        
        $paymentassigns = Payment::where('type', 0)->get();
        $departments = DB::table('course_selection')->get();
    
        return view('admin.setting.paymentassign', compact('paymentassigns', 'departments', 'paymentSettings'));
    }
    
   
    public function paymentsettingstore(Request $request)
    {
        $request->validate([
            "name" => "required|string|min:5|max:20",
            "type" => "required|numeric",
            "price" => "nullable|integer",
            'category' => "nullable|integer",
        ]);
        $user_id = Auth::user()->id;
        $createpayment = new Payment();
        $createpayment->name = $request->name;
        $createpayment->type = $request->type;
        $createpayment->price = $request->price;
        $createpayment->category = $request->category;
        $createpayment->user_id = $user_id;
        if ($createpayment->save()) {
            return back()->with('success', 'payment created successfully');
        } else {
            return back()->with('error', 'An error occurred while creating the payment');
        }
    }

    public function paymentassignstore(Request $request)
    {
        $request->validate([
            "department" => "required|array",
            "type" => "required|numeric",
            "price" => "nullable|integer",
            "category" => "nullable|integer",

        ]);

        $user_id = Auth::user()->id;
        $paymentType = $request->type;
        $departments = $request->department;
        $category = $request->category;

        foreach ($departments as $department) {
            if (PaymentAssign::where('department', $department)->where('category', $category)->where('payment_id', $paymentType)->exists()) {
                return back()->with('error', 'A payment assignment already exists for department: ' . $department);
            }
        }

        foreach ($departments as $department) {
            $assignpayment = new PaymentAssign();
            $assignpayment->payment_id = $paymentType;
            $assignpayment->department = $department;
            $assignpayment->category = $category;
            $assignpayment->price = $request->price;
            $assignpayment->user_id = $user_id;

            if (!$assignpayment->save()) {
                return back()->with('error', 'An error occurred while assigning the payment');
            }
        }

        return back()->with('success', 'Payment assignments created successfully');
    }

    public function paymentassigndelete($id)
    {
        $paymentsettings = PaymentAssign::find($id);
        if ($paymentsettings->delete()) {
            return back()->with('success', 'Payment assign deleted successfully');
        } else {
            return back()->with('error', 'An error occurred while deleting payment assigning');
        }
    }
}
