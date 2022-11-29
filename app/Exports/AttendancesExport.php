<?php

namespace App\Exports;

// use App\Models\Attendance;
// use Maatwebsite\Excel\Concerns\FromCollection;

// class AttendancesExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         //
//         return Attendance::all();
//     }
// }
use App\Models\Attendance;
use App\Models\Attendance as ModelsAttendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendancesExport implements FromView
{
    public function view(): View
    {
        return view('hrm.attendance.index-admin', [
            'attendances' => Attendance::all()
        ]);
    }
}
