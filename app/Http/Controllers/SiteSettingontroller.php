<?php

namespace App\Http\Controllers;

use App\Models\PaymentAssign;
use App\Models\SiteConfig;
use Illuminate\Http\Request;

class SiteSettingontroller extends Controller
{


    public function sitesetting()
    {
        $sitesettings = SiteConfig::all();
        return view('admin.setting.sitesetting', compact('sitesettings'));
    }

    public function sitesettingupdate(Request $request)
    {
        $siteSettings = $request->input('site_settings');

        foreach ($siteSettings as $id => $data) {
            $siteSetting = SiteConfig::find($id);
            if ($siteSetting) {
                $siteSetting->update($data);
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully');
    }

    public function paymentassignupdate(Request $request)
    {
        $siteSettings = $request->input('site_settings');

        foreach ($siteSettings as $id => $data) {
            $siteSetting = PaymentAssign::find($id);
            if ($siteSetting) {
                $siteSetting->update($data);
            }
        }

        return redirect()->back()->with('success', 'Payment assign updated successfully');
    }
}
