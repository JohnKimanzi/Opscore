<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses=[
            [
                'name'=>'Active'
            ],
            [
                'name'=>'Dormant'
            ],
            [
                'name'=>'Close'
            ],
            [
                'name'=>'Deactivate'
            ],
            [
                'name'=>'Delete'
            ]
        ];

        DB::table('statuses')->insert($statuses);
    }
}
