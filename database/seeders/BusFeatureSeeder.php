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
            __('A/C'),
            __('ABS'),
            __('ASR'),
            __('DVD'),
            __('VIDEO+2 monitoriai'),
            __('CD'),
            __('WC'),
            __('Šaldytuvas'),
            __('Mini virtuvėlė'),
            __('Mikrofonas'),
        ];

        foreach ($features as $feature) {
            BusFeature::create([
                'name' => $feature,
                'active' => true
            ]);
        }
    }
}
