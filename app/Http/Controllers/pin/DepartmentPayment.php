<?php

namespace App\Http\Controllers\pin;

use App\Models\Payment;
use App\Models\SiteConfig;
use Illuminate\Http\Request;
use App\Models\PaymentAssign;
use App\Models\SchoolPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\candidate\Candidate_info;
use Illuminate\Http\Client\RequestException;

class DepartmentPayment extends Controller
{
    public function index()
    {
        $departmentpaymentsindigenes = PaymentAssign::where('payment_id', 2)->where('category', 1)->get();
        $departmentpaymentsnonindigenes = PaymentAssign::where('payment_id', 2)->where('category', 2)->get();

        return view('auth.payment.department.index', compact('departmentpaymentsindigenes', 'departmentpaymentsnonindigenes'));
    }
    public function indigene($id)
    {
        $payments = PaymentAssign::where('payment_id', $id)->where('category', 1)->get();
        $name = Payment::find(2);
        $category = 'Indigene';
        return view('auth.payment.department.payment', compact('payments', 'category', 'name'));
    }

    public function nonindigene($id)
    {
        $payments = PaymentAssign::where('payment_id', $id)->where('category', 2)->get();
        $name = Payment::find(2);
        $category = 'Non-indigene';
        return view('auth.payment.department.payment', compact('payments', 'category', 'name'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|min:1|max:13',
                'email' => 'required|email',
                'department' => 'required',
                'fullname' => 'required',
                'session' => 'required',
                'admissionnumber' => 'required|exists:candidate_info,admissionnumber',

            ]);

            $get_public_apiKey = SiteConfig::where('id', 7)->first();
            $get_payment_amount = PaymentAssign::where('id', $request->department)->first();
            $get_callback_url_school_fees = SiteConfig::where('id', 11)->pluck('price')->first();
            $base_url = SiteConfig::where('id', 10)->pluck('price')->first();
            $apiKey = $get_public_apiKey->price;
            $url = $base_url . '/transaction/initialize';
            $sumamount = $get_payment_amount->price + 900;

            $amount = $sumamount * 100;
            $requestData = [
                'email' => $request->email,
                'amount' => $amount,
                'api-public-key' => $apiKey,
                'callbackUrl' => $get_callback_url_school_fees,
            ];

            $response = Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, $requestData);

            $statusCode = $response->status();
            $responseData = $response->json();
            $message = $responseData['message'];
            $name = Payment::find(2);

            if ($statusCode === 200) {
                $authorizationUrl = $responseData['data']['authorizationUrl'];
                $candidatesave = SchoolPayment::create([
                    'purpose' => $name->name,
                    'email' => $request->email,
                    'amount' => $sumamount,
                    'phone' => $request->phone,
                    'time' => now(),
                    'status' => 0,
                    'code' => $this->CodeNumber(),
                    'fullname' => $request->fullname,
                    'department' => $request->department,
                    'admissionnumber' => $request->admissionnumber,
                    'session' => $request->session,
                    'authorizationUrl' => $authorizationUrl,
                    'reference' => $responseData['data']['reference'],
                    'credoReference' => $responseData['data']['credoReference'],
                ]);
                return view('open-new-tab', ['authorizationUrl' => $authorizationUrl]);
            } else {
                return back()->withErrors(['error' => "Error $statusCode: $message"]);
            }
        } catch (RequestException $e) {
            if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                return back()->withErrors(['error' => 'Could not connect to the server. Please check your internet connection.']);
            } else {
                return back()->withErrors(['error' => 'An error occurred while processing your request.']);
            }
        }
    }
    public static function CodeNumber()
    {
        $characters = '0123456789';
        $length = 10;
        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while (SchoolPayment::where('code', $code)->exists());

        return $code;
    }

    public function callback(Request $request)
    {
        try {
            $transRef = $request->query('transRef');
            $apiKeysecrect = '0PRI0535pD2xv3MCsDd6bFj1Ih7MQcP7';
            $base_url = SiteConfig::where('id', 10)->pluck('price')->first();
            $verifyUrl = $base_url . "/transaction/{$transRef}/verify";
            $requestData = [
                'api-secret-key' => $apiKeysecrect,
                'transRef' => $transRef,
            ];
            $response = Http::withHeaders([
                'Authorization' => $apiKeysecrect,
                'Content-Type' => 'application/json',
            ])->get($verifyUrl, $requestData);

            $statusCode = $response->status();
            $responseData = $response->json();

            if ($statusCode === 200) {
                $reference = $responseData['data']['businessRef'];
                $customer = SchoolPayment::where('reference', $reference)->first();
                $candidateInfo = Candidate_info::with(
                    'candidateInstitution',
                    'candidateAcademic',
                    'candidateOlevel'
                )->where('admissionnumber', $customer->admissionnumber)->first();
                if ($customer) {
                    $customer->update(['status' => 1]);
                    $pdf = Pdf::loadView(
                        'receiptpage',
                        compact('customer','candidateInfo')
                    )->setPaper('a4',);
                    return $pdf->stream($customer->purpose.'_'.$customer->admissionnumber.'.pdf');
                    
                 } else {
                    return Redirect()->route('payment.department.index')->with('error', 'Customer not found for the given reference.');
                }
            } else {
                $errorMessage = $responseData['error'] ?? 'Unknown error occurred.';
                return Redirect()->route('payment.department.index')->with('error', "Error $statusCode: $errorMessage");
            }
        } catch (\Exception $e) {
            return Redirect()->route('payment.department.index')->with('error', 'Could not connect to the server. Please check your internet connection.');
        }
    }

    // public function download_pin($customerId)
    // {

    //     $user = Customer::findOrFail($customerId);
    //     $expire_at = SiteConfig::where('id', 6)->pluck('price')->first();

    //     $pins = PinStore::where('customer_id', $customerId)->first();
    //     $pdf = Pdf::loadView(
    //         'emails.pinpdf',
    //         compact('pins', 'expire_at')
    //     )->setPaper('a6', 'landscape');
    //     return $pdf->download('Candidate_registration_pin.pdf');
    // }
}
