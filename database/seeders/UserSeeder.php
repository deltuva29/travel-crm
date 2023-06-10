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
                'name' => 'Mindaugas D.',
                'email' => 'deltuva.mindaugas@gmail.com',
                'phone_number' => '+37066444444',
                'is_root' => false,
            ],
        ])->each(function ($superAdmin) {
            User::create(User::factory()->raw($superAdmin));
        });
    }
}
