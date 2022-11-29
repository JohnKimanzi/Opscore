<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillingFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $frequencies=[
            [
                'name'=>'Daily',
            ],
            [
                'name'=>'Weekly'
            ],
            [
                'name'=>'Monthly'
            ],
            [
                'name'=>'Quarterly'
            ],
            [
                'name'=>'Half Yearly'
            ],
            [
                'name'=>'Annually'
            ],
            [
                'name'=>'One Off'
            ]
        ];

        DB::table('billing_frequencies')->insert($frequencies);

    }
}
