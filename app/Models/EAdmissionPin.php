<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EAdmissionPin extends Model
{
    use HasFactory;
    protected $table = 'e_admission_pin';

    protected $fillable = [
        'serial',
        'admissionnumber',
        'pin',
    ];
    
      public static function serialNumber($length)
    {
        $characters = '0123456789';
        $serial = '';

        for ($i = 0; $i < $length; $i++) {
            $serial .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $serial;
    }

    public static function generateUniqueNumbers($length, $amount)
    {
        $pins = [];

        while (count($pins) < $amount) {
            $pin = self::serialNumber($length);
            if (!EAdmissionPin::where('pin', $pin)->exists()) {
                $pins[] = $pin;
            }
        }

        foreach ($pins as $pin) {
            EAdmissionPin::create([
                'pin' => $pin,
                'serial' => self::serialNumber($length),
                'admissionnumber' => 0,
            ]);
        }

        return $pins;
    }
    
}
