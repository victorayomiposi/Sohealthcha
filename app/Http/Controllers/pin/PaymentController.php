<?php

namespace App\Http\Controllers\pin;

use Carbon\Carbon;
use App\Mail\PinMail;
use App\Models\Payment;
use App\Models\Customer;
use App\Mail\FeedbackMail;
use App\Models\pin\PinStore;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Mail\TransactionStatusMail;
use App\Http\Controllers\Controller;
use App\Mail\CustomerMessage;
use App\Models\SiteConfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Client\RequestException;
use Maatwebsite\Excel\Mixins\DownloadQueryMacro;

class PaymentController extends Controller
{
    public function index()
    {
        $appconfig = SiteConfig::whereNotIn('id', [3, 4, 5, 6, 7, 8, 9, 10, 11, 12,13])->get();
        $departmentpayments = Payment::where('type', 0)->get();
        $generalpayments = Payment::where('type', 1)->get();
        $topup = SiteConfig::find(13);

        return view('auth.payment.index', compact('appconfig', 'generalpayments', 'departmentpayments','topup'));
    }

    public function create()
    {
        $appconfig = SiteConfig::whereNotIn('id', [3, 4, 5, 6, 7, 8, 9, 10, 11, 12,13])->get();
        return view('auth.payment.payments', compact('appconfig'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'phone' => 'required|min:1|max:13',
                'email' => 'required|email',
                'type' => 'required',
                'pinnumber' => 'nullable|exists:pin_stores,pinnumber',
                'serialnumber' => 'nullable|exists:pin_stores,serialnumber',
                'access_code' => 'nullable|exists:pin_stores,code',

            ]);

            $get_public_apiKey = SiteConfig::where('id', 7)->first();
            $get_payment_amount = SiteConfig::where('id', $request->type)->first();
            $get_callback_url = SiteConfig::where('id', 9)->pluck('price')->first();
            $base_url = SiteConfig::where('id', 10)->pluck('price')->first();
            $get_callback_url = SiteConfig::where('id', 9)->pluck('price')->first();
            $apiKey = $get_public_apiKey->price;
            $url = $base_url . '/transaction/initialize';
            $sumamount = $get_payment_amount->price + 900;
            $timeout = 300;

            
            $amount = $sumamount * 100;
            $requestData = [
                'email' => $request->email,
                'amount' => $amount,
                'api-public-key' => $apiKey,
                'callbackUrl' => $get_callback_url,
            ];

            $response = Http::timeout($timeout)->withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post($url, $requestData);
              
            $statusCode = $response->status();
            $responseData = $response->json();
            $message = $responseData['message'];

            if ($statusCode === 200) {
                $authorizationUrl = $responseData['data']['authorizationUrl'];
                $candidatesave = Customer::create([
                    'purpose' => $get_payment_amount->name,
                    'code' => $get_payment_amount->code,
                    'email' => $request->email,
                    'amount' => $sumamount,
                    'phone' => $request->phone,
                    'time' => now(),
                    'status' => 0,
                    'pinnumber' => $request->pinnumber,
                    'serialnumber' => $request->serialnumber,
                    'access_code' => $request->access_code,
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
                $customer = Customer::where('reference', $reference)->first();
                $pinStoreExists = PinStore::where('customer_id', $customer->id)->first();

                if ($customer && $customer->code == 1001) {
                    $customer->update(['status' => 1]);
                    if ($pinStoreExists) {
                        $customerid = $customer->id;
                        return view('pin.downloadpage', compact('customerid'));
                    } else {
                        $pins = PinStore::generateUniqueNumbersOnline(12, 1, $customer->id);
                        $customerid = $customer->id;
                        return view('pin.downloadpage', compact('customerid'));
                    }
                } elseif ($customer && $customer->code == 1002) {
                    $currentsession = date('Y');
                    $pinExists = PinStore::where(
                        'session',
                        $currentsession
                    )->where(
                        'pinnumber',
                        $customer->pinnumber
                    )->where(
                        'code',
                        $customer->access_code
                    )->where(
                        'serialnumber',
                        $customer->serialnumber
                    )->where(
                        'admissionnumber',
                        0
                    )->first();
                    if ($pinExists->update(['late' => 1])) {
                        return redirect()->route('payment.create')->with('success', 'Pin renewed successfully.');
                    } else {
                        return redirect()->route('payment.create')->with('error', 'An error occurred while renewing the pin successfully.');
                    }
                } else {
                    return Redirect()->route('payment.create')->with('error', 'Customer not found for the given reference.');
                }
            } else {
                $errorMessage = $responseData['error'] ?? 'Unknown error occurred.';
                return Redirect()->route('payment.create')->with('error', "Error $statusCode: $errorMessage");
            }
        } catch (\Exception $e) {
            return Redirect()->route('payment.create')->with('error', 'Could not connect to the server. Please check your internet connection.');
        }
    }

    public function download_pin($customerId)
    {

        $user = Customer::findOrFail($customerId);
        $expire_at = SiteConfig::where('id', 6)->pluck('price')->first();

        $pins = PinStore::where('customer_id', $customerId)->first();
        $pdf = Pdf::loadView(
            'emails.pinpdf',
            compact('pins', 'expire_at')
        )->setPaper('a6', 'landscape');
        return $pdf->download('Candidate_registration_pin.pdf');
    }
}
