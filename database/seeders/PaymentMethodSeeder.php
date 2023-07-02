<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            __('Grynaisiais kelionės metu'),
        ];

        foreach ($methods as $method) {
            PaymentMethod::create([
                'name' => $method,
                'active' => true
            ]);
        }
    }
}
