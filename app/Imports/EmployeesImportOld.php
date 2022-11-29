<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Office;
use App\Models\Project;
use App\Models\Designation;
use App\Models\Country;
use App\Models\Department;
use App\Models\Contract;
use App\Models\Team;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function startRow(): int
    {
        return 2;
    }
    protected function get_country_id($name){
       
            $res = Country::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
        
      
    }
    public function get_contract_id($name)
    {
        $res = Contract::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    public function get_department_id($name)
    {
        $res = Department::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    public function get_designation_id($name)
    {
        $res = Designation::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    public function get_project_id($name)
    {
        $res = Project::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    public function get_team_id($name)
    {
        $res = Team::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    public function get_office_id($name)
    {
        $res = Office::whereRaw('lower(name) like (?)',["%{$name}%"] )->first();
            if($res!=null)
                return $res->id;
    }
    
    public function model(array $row)
    { 
        // dd(Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15])));
        return new Employee([
            'sap'=>$row[0],
            'first_name'=>$row[1],
            'middle_name' =>$row[2],
            'last_name' =>$row[3],
            'gender'=>$row[4],
            'dob'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])),
            'country_id' => $this->get_country_id( $row[6]),
    
    
            'phone1'=>$row[7],
            'phone2'=>$row[8],
            'work_email'=>$row[9],
            'personal_email'=>$row[10],
            // 'personal_email2'=>$row[11],
            'residence'=>$row[11],
            'permanent_address'=>$row[12],
    
            'contract_id' => $this->get_contract_id( $row[13]),
            'contract_start'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14])),
            'contract_expiry'=>Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15])),
            'department_id' => $this->get_department_id( $row[16]),
            'designation_id' => $this->get_designation_id( $row[17]),
            // 'shift_flexibility'=>$row[19],
            'project_id'=> $this->get_project_id(  $row[18]),
            // 'team_id'=> $this->get_team_id($row[19]),
            // 'office_id' => $this->get_office_id( $row[22]),
    
            'national_id'=>$row[22],
            'passport_number'=>$row[23],
            'huduma_number'=>$row[24],
            'kra_pin'=>$row[25],
            'nssf'=>$row[26],
            'nhif'=>$row[27],
    
            'highest_education_level'=>$row[28],
    
            'area_of_specialization'=>$row[30],
    
            'bank_name'=>$row[33],
            'bank_branch'=>$row[34],
            'branch_code'=>$row[35],
            'account_name'=>$row[36],
            'account_number'=>$row[37],
    
            'blood_group_id'=>$row[37],
            'disability'=>$row[39],
            'disability_details'=>$row[40],
        ]);
    }
}
