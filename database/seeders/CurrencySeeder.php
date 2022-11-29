<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies=[
            [
                'name'=>'KES'
            ],
            [
                'name'=>'TZS'
            ],
            [
                'name'=>'UGX'
            ],
            [
                'name'=>'ZMW'
            ],
            [
                'name'=>'MWK'
            ],
            [
                'name'=>'ETB'
            ],
            [
                'name'=>'GHS'
            ],
            [
                'name'=>'RSW'
            ],
            [
                'name'=>'EUR'
            ],
            [
                'name'=>'USD'
            ]
        ];

        DB::table('currencies')->insert($currencies);
    }
}
