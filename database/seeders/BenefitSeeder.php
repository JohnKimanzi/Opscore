<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $benefits=[
            [
                'name'=>'Airtime Allowance'
            ],
            [
                'name'=>"Medical Allowance"
            ],
            [
                'name'=>'Asset Issues'
            ]
        ];

        DB::table('benefits')->insert($benefits);
    }
}
