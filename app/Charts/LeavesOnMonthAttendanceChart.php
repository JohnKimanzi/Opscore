<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class LeavesOnMonthAttendanceChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $today = Carbon::today();
        $dates = [];

        for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
            $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-F-d');
        }
        dd($dates);
        $AnnualLeaveCountThisMonth = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->leaves->where('leave_category_id', 1)->where('end_date', '>', Carbon::now()->subMonths(1)->endOfMonth())->pluck('leave_days', $dates);
        $sickLeaveCountThisMonth = Auth::user()->employee->teams_i_can_manage->flatMap->members->flatMap->leaves->where('leave_category_id', 2)->where('end_date', '>', Carbon::now()->subMonths(1)->endOfMonth())->pluck('leave_days', $dates);
        // $period = range(1, Carbon::now()->month()->daysInMonth);
        // dd($dates);
        // $time = strtotime(json_encode($dates));
        // dd(idate('d', $time));
        return $this->chart->barChart()
            ->setTitle('This Month Leaves on Attendance Spread.')
            // ->setSubtitle('Physical sales vs Digital sales.')
            // ->addData('Annual Leave', [$AnnualLeaveCountThisMonth->count()])
            // ->addData('Sick Off Leave', [$sickLeaveCountThisMonth->count()])
            ->setLabels($dates)
            ->setDataSet([
                [
                    "name" => "Annual Leave",
                    "data" => [$AnnualLeaveCountThisMonth->count()]
                ],
                [
                    "name" => "Sick Off Leave",
                    "data" => [$sickLeaveCountThisMonth->count()]
                ]
            ])
            // ->setXAxis([
            //         "type" => "datetime",
            //         "categories" => $dates,
            //         "ticks" => ["autoskip"=>false]
            // ])
            // ->setDataLabels(true)
            ->setXAxis($dates)
            ->setHorizontal(true)
            ->setColors(['#ffc63b', '#ff6384']);
    }
}
