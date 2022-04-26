<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkType;

class WorkTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $work_type = ['IProspect Individual Work', 'Internal Meeting'];

        for ($i = 0; $i < 2; $i++) {
            WorkType::create([
                'type' => $work_type[$i]
            ]);
        }
    }
}
