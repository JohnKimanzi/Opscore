<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels=[
            [
                'name'=>'Phd'
            ],
            [
                'name'=>'Masters'
            ],
            [
                'name'=>'Bachelors'
            ],
            [
                'name'=>'Diploma'
            ],
            [
                'name'=>'Certificate'
            ]
        ];

        DB::table('education_levels')->insert($levels);
    }
}
