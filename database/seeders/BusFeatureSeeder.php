<?php

namespace Database\Seeders;

use App\Models\BusFeature;
use Illuminate\Database\Seeder;

class BusFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $features = [
            'A/C',
            'ABS',
            'ASR',
            'DVD',
            'VIDEO+2 monitoriai',
            'CD',
            'WC',
            'Šaldytuvas',
            'Mini virtuvėlė',
            'Mikrofonas',
        ];

        foreach ($features as $feature) {
            BusFeature::create([
                'name' => $feature,
                'active' => true
            ]);
        }
    }
}
