<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $status=[
           [
               'name'=>'Active'
           ],
           [
               'name'=>'Attrition'
           ]
       ];

       DB::table('employee_statuses')->insert($status);
    }
}
