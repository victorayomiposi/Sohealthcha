<?php

namespace App\Http\Controllers\pin;

use App\Models\SiteConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdditionalPaymentController extends Controller
{
    public function create()
    {
        $topup = SiteConfig::find(13);
        return view('auth.payment.additionpayment', compact('topup'));
    }

    public function check(Request $request)
    {
      dd($request);
    }
}
