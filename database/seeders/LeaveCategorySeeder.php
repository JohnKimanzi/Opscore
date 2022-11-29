<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LeaveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            [
                'name'=>'Annual Leave',
                'days'=>'21',
                'description'=>'Paternity Leave'
            ],
            [
                'name'=>'Paternity Leave',
                'days'=>'14',
                'description'=>''
            ],
            [
                'name'=>'Maternity Leave',
                'days'=>'90',
                'description'=>'Paternity Leave'
            ],
            [
                'name'=>'Sick Leave',
                'days'=>'10',
                'description'=>'Sick Leave'
            ],
            [
                'name'=>'Compassionate Leave',
                'days'=>'5',
                'description'=>'Compassionate Leave'
            ],
        ];
    }
}
