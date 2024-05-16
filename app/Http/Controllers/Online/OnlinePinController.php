<?php

namespace App\Http\Controllers\Online;

use App\Models\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OnlinePinController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $usepin = $request->input('usepin');
        $search = $request->input('search');
        $existingPin = DB::table('pinstore')->where('status', 1)->orderBy('id', 'desc');
        if ($usepin == 1) {
            $existingPin->where('admissionnumber', '>', 0);
        } else {
            $existingPin->where('admissionnumber', '=', 0)->orWhereNull('admissionnumber');
        }
        if ($search) {
            $existingPin->where(function ($q) use ($search) {
                $q->where('admissionnumber', 'like', '%' . $search . '%')
                    ->orWhere('pinnumber', 'like', '%' . $search . '%')
                    ->orWhere('serialnumber', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%');
            });
        }
        $existingPin = $existingPin->paginate($perPage);
        return view('admin.pin.online.create', compact('existingPin'));
    }


    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'pin_expiry_date' => 'nullable|date',
        //     'pin_price' => 'nullable|numeric',
        //     'pin_expiry_price' => 'nullable|numeric',
        //     'form_status' => 'nullable|boolean',
        // ]);

        $siteConfigID = SiteConfig::where('code', 1)->first();

        $siteConfigUpdate = SiteConfig::find(1);
        $siteConfigUpdate->update([
            'pin_expiry_date' => $request->has('pin_expiry_date') ? $request->pin_expiry_date : $siteConfigUpdate->pin_expiry_date,
            'pin_price' => $request->has('pin_price') ? $request->pin_price : $siteConfigUpdate->pin_price,
            'pin_expiry_price' => $request->has('pin_expiry_price') ? $request->pin_expiry_price : $siteConfigUpdate->pin_expiry_price,
            'form_status' => $request->has('form_status') ? $request->form_status : $siteConfigUpdate->form_status,
        ]);


        return redirect()->back()->with('success', 'Configuration updated successfully');
    }


    public function destroy($id)
    {
        //
    }
}
