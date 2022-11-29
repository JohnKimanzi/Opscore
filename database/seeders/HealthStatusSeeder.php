<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HealthStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status=[
            [
                'name'=>'Yes'
            ],
            [
                'name'=>'No'
            ]
        ];

        DB::table('health_statuses')->insert($status);
    }
}
