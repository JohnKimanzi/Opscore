<?php

namespace App\Charts;

use App\Models\Employee;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class EmployeesGenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $femaleCount = Employee::where('gender_id', '=', 2)->count();
        $maleCount = Employee::where('gender_id', '=', 1)->count();
        // $totalEmployees = Employee::all()->count();
        // $femalePercentCount = ($femaleCount) ? ($femaleCount/$totalEmployees)*100 : 0;
        // $malePercentCount = ($maleCount) ? ($maleCount/$totalEmployees)*100 : 0;
        return $this->chart->donutChart()
            // ->setTitle('Employee Gender Statistics.')
            // ->setSubtitle('Season 2021.')
            ->addData([
                round($femaleCount),
                round($maleCount)
            ])
            ->setColors(['#504C6A','#F58220'])
            ->setLabels(['Female', 'Male']);
    }
}
