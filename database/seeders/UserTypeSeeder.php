<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Supervisor', 'Intern or Freelancer', 'Human Resource'];

        for ($i = 0; $i < 3; $i++) {
            UserType::create([
                'type' => $roles[$i]
            ]);
        }
    }
}
