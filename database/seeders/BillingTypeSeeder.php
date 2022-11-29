<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types=[
            [
                'name'=>'Hourly'
            ],
            [
                'name'=>'Headcount'
            ],
            [
                'name'=>'Call'
            ],
            [
                'name'=>'Task'
            ]
        ];

        DB::table('billing_types')->insert($types);
    }
}
