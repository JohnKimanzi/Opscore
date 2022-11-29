<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisabilityStatusSeeder extends Seeder
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

        DB::table('disability_statuses')->insert($status);
    }
}
