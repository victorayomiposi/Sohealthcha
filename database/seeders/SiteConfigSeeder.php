<?php

namespace Database\Seeders;

use App\Models\SiteConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteConfigSeeder extends Seeder
{

    public function run()
    {
        SiteConfig::create([
            'id' => 1,
            'code' => 1001,
            'name' => 'Candidate Form Pin Payment',
            'price' => 1000,
        ]);

        SiteConfig::create([
            'id' => 2,
            'code' => 1001,
            'name' => 'Late Candidate Form Pin Payment',
            'price' => 21000,
        ]);

        SiteConfig::create([
            'id' => 3,
            'code' => 1001,
            'name' => 'Pin expiry price',
            'price' => 1000,
        ]);

        SiteConfig::create([
            'id' => 4,
            'code' => 1111,
            'name' => 'Candidate Registration Form Status',
            'price' => 21000,
        ]);
    }
}
