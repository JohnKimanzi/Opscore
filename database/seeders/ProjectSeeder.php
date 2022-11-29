<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects=[
            [
                'name'=>'Project Services',
                'client_id'=>1
            ],
            [
                'name'=>'SNV',
                'client_id'=>2
            ],
            [
                'name'=>'UNHCR',
                'client_id'=>3
            ],
            [
                'name'=>'UCDA',
                'client_id'=>4
            ],
            [
                'name'=>'EABL',
                'client_id'=>5
            ],
            [
                'name'=>'Isuzu East Africa',
                'client_id'=>6
            ],
            [
                'name'=>'TotalEnergies',
                'client_id'=>7
            ],
            [
                'name'=>'Zuku',
                'client_id'=>8
            ],
            [
                'name'=>'Toyota Kenya',
                'client_id'=>9
            ], 
            [
                'name'=>'HMN',
                'client_id'=>10
            ],
            [
                'name'=>'SCJ',
                'client_id'=>11
            ],
            [
                'name'=>'AMC',
                'client_id'=>12
            ],
            [
                'name'=>'Sproxil',
                'client_id'=>13
            ],
            [
                'name'=>'Viva',
                'client_id'=>14
            ],
            [
                'name'=>'DT Dobie',
                'client_id'=>15
            ],
            [
                'name'=>'Chipper Cash',
                'client_id'=>16
            ],
            [
                'name'=>'ULG',
                'client_id'=>17
            ],
            [
                'name'=>'Telkom Kenya',
                'client_id'=>18
            ],
            [
                'name'=>'MRC',
                'client_id'=>19
            ],
        ];

            
        DB::table('projects')->insert($projects);


    }
}
