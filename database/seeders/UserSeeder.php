<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'TravelCRM',
                'email' => 'info@crm.travel.lt',
                'is_root' => false,
            ],
        ])->each(function ($superAdmin) {
            $user = User::create(User::factory()->raw($superAdmin));
            $user->assignRole('Super administratorius');
        });
    }
}
