<?php

namespace Database\Seeders;

use App\Models\BusType;
use Illuminate\Database\Seeder;

class BusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            '2 aukštų',
            'Standartinis',
        ];

        foreach ($types as $type) {
            BusType::create([
                'name' => $type
            ]);
        }
    }
}
