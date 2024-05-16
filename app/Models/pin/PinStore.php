<?php

namespace App\Models\pin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PinStore extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['session','pinnumber', 'serialnumber', 'customer_id', 'admissionnumber', 'user_id', 'status','late', 'code', 'password'];

    public static function serialNumber($length)
    {
        $characters = '0123456789';
        $serial = '';

        for ($i = 0; $i < $length; $i++) {
            $serial .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $serial;
    }

    public static function authenticationcode($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $authcode = '';

        for ($i = 0; $i < $length; $i++) {
            $authcode .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $authcode;
    }

    public static function generateUniqueNumbers($length, $amount)
    {
        $pins = [];

        while (count($pins) < $amount) {
            $pin = self::serialNumber($length);
            if (!PinStore::where('pinnumber', $pin)->exists()) {
                $pins[] = $pin;
            }
        }

        foreach ($pins as $pin) {
            $generateuniquecode = substr(uniqid(), 0, 13);
            $year = date('Y');
            PinStore::create([
                'pinnumber' => $pin,
                'status' => 0,
                'session' => $year,
                'late' => 0,
                'code' => $generateuniquecode,
                'serialnumber' => self::serialNumber($length),
            ]);
        }

        return $pins;
    }

    public static function generateUniqueNumbersOnline($length, $amount, $customerID)
    {
        $pins = [];

        while (count($pins) < $amount) {
            $pin = self::serialNumber($length);
            if (!PinStore::where('pinnumber', $pin)->exists()) {
                $pins[] = $pin;
            }
        }

        foreach ($pins as $pin) {
            $generateuniquecode = substr(uniqid(), 0, 13);
            $year = date('Y');
            PinStore::create([
                'pinnumber' => $pin,
                'serialnumber' => self::serialNumber($length),
                'late' => 0,
                'session' => $year,
                'status' => 1,
                'customer_id' => $customerID,
                'code' => $generateuniquecode,
            ]);
        }


        return $pins;
    }
}
