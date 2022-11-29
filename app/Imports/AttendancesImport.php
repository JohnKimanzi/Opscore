<?php
namespace App\Imports;

use App\Models\Attendance;
use App\Models\Employee;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AttendancesImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        // start from excel row number
        return 3;
    }
    private function getEmployeeId($sap)
    {
         try {
            return Employee::where('sap', $sap)->first()->id;
         } catch (\Throwable $th) {
             throw $th;
         }       
    }
    public function model(array $row)
    {
        return Attendance::UpdateOrCreate(
            [
                'employee_id'=>$this->getEmployeeId($row[1]),
                'record_date'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3])),
            ],
            [
                'team_leader'=>$this->getEmployeeId($row[4]), 
                'status'=>$row[5], 
                'comments'=>$row[6],
            ]
        );
    }
}