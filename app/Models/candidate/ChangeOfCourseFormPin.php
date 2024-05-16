<?php

namespace App\Models\candidate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeOfCourseFormPin extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'changeofcourseformpin';

    protected $fillable = ['pin', 'serial', 'course_available', 'admissionnumber', 'course'];

    public static function serialNumber($length)
    {
        $characters = '0123456789';
        $serial = '';

        for ($i = 0; $i < $length; $i++) {
            $serial .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $serial;
    }

    public static function generateUniqueNumbers($length, $amount, $course)
    {
        $pins = [];

        while (count($pins) < $amount) {
            $pin = self::serialNumber($length);
            if (!self::where('pin', $pin)->exists()) {
                $pins[] = $pin;
            }
        }

        foreach ($pins as $pin) {
            self::create([
                'pin' => $pin,
                'serial' => self::serialNumber($length),
                'course_available' => $course,
            ]);
        }

        return $pins;
    }
}
