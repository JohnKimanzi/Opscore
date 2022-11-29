<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=[
            [
                'name'=>'Project Services'
            ],
            [
                'name'=>'SNV'
            ],
            [
                'name'=>'UNHCR'
            ],
            [
                'name'=>'UCDA'
            ],
            [
                'name'=>'EABL'
            ],
            [
                'name'=>'Isuzu East Africa'
            ],
            [
                'name'=>'TotalEnergies'
            ],
            [
                'name'=>'Zuku'
            ],
            [
                'name'=>'Toyota Kenya'
            ],
            [
                'name'=>'HMN'
            ],
            [
                'name'=>'SCJ'
            ],
            [
                'name'=>'AMC'
            ],
            [
                'name'=>'Sproxil'
            ],
            [
                'name'=>'Viva'
            ],
            [
                'name'=>'DT Dobie'
            ],
            [
                'name'=>'Chipper Cash'
            ],
            [
                'name'=>'ULG'
            ],
            [
                'name'=>'Telkom Kenya'
            ],
            [
                'name'=>'MRC'
            ],
        ];

        DB::table('clients')->insert($clients);
    }
}
