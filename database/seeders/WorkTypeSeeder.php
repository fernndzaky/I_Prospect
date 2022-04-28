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
        $work_type = ['iProspect Project Work', 'iProspect individual Work', 'iProspect Project Meeting'
        , 'Internal Meeting', 'Internal Training', 'Professional Development', 'Planned Absence', 'Unplanned Absence'
        , 'Public Holidays', 'Unassigned'];

        for ($i = 0; $i < count($work_type); $i++) {
            WorkType::create([
                'type' => $work_type[$i]
            ]);
        }
    }
}
