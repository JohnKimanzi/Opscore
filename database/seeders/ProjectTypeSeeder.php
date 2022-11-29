<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTypeSeeder extends Seeder
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
                'name'=>'Inbound'
            ],
            [
                'name'=>'Outbound'
            ],
            [
                'name'=>'Social Media'
            ],
            [
                'name'=>'Data'
            ],
            [
                'name'=>'Tracking Services'
            ],
            [
                'name'=>'Project services'
            ],
            [
                'name'=>'Transcription'
            ],
        ];

        DB::table('project_types')->insert($types);
    }
}
