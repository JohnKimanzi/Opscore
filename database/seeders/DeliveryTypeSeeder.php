<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTypeSeeder extends Seeder
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
                'name'=>"In-house"
            ],
            [
                'name'=>'Client site'
            ],
            [
                'name'=>"CTC deployment"
            ],
        ];

        DB::table('delivery_types')->insert($types);
    }
}
