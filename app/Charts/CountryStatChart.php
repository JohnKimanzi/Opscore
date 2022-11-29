<?php

namespace App\Charts;

use App\Models\Employee;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CountryStatChart
{
    protected $chart2;

    public function __construct(LarapexChart $chart2)
    {
        $this->chart2 = $chart2;
    }

    public function build()
    {
        $kenyanEmployees=Employee::where('country_id',110)->count();
        $ugandaEmployees=Employee::where('country_id',222)->count();
        $tanzaniaEmployees=Employee::where('country_id',210)->count();;
        $zambiaEmployees=Employee::where('country_id',238)->count();
        $malawiEmployees=Employee::where('country_id',128)->count();
        $ghanaEmployees=Employee::where('country_id',81)->count();
        $ethiopiaEmployees=Employee::where('country_id',68)->count();
        
        return $this->chart2->pieChart()
            // ->setTitle('Country Demographics.')
            ->addData([$kenyanEmployees,$ugandaEmployees,$tanzaniaEmployees,$zambiaEmployees, $malawiEmployees,$ghanaEmployees,$ethiopiaEmployees])
            ->setColors(['#504C6A','#F58220','#000000','#FF0000', '#FFFF00', '#00FF00', '#0000FF'])
            ->setLabels(['Kenya', 'Uganda', 'Tanzania', 'Zambia', 'Malawi', 'Ghana', 'Ethiopia']);
    }
}
