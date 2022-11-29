<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services=[
            [

                'name'=>'Customer Support'
            ],
            [
                'name'=>'Telesales'
            ],
            [
                'name'=>'CSAT Surveys'
            ],
            [
                'name'=>'Collections'
            ],
            [
                'name'=>'Data Verification'
            ],
            [
                'name'=>'Tracking Services'
            ],
            [
                'name'=>'Market Surveys'
            ],
            [
                'name'=>'Lead Generation'
            ],
            [
                'name'=>'Data Cleaning'
            ],
            [
                'name'=>'Transcription'
            ],
            [
                'name'=>'Social Media Support'
            ],
            [
                'name'=>'Digitization'
            ],
            [
                'name'=>'Support'
            ],
            [
                'name'=>'Management'
            ],
            [
                'name'=>'Retention'
            ],
            [
                'name'=>'CSI Surveys'
            ],
            [
                'name'=>'Service Booking'
            ],
            [
                'name'=>'KYC'
            ]
        ];
        DB::table('service_types')->insert($services);
    }
}
