<?php

namespace App\Imports;

use App\Models\BloodGroup;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Project;
use App\Models\Designation;
use App\Models\Country;
use App\Models\Department;
use App\Models\Contract;
use App\Models\EducationLevel;
use App\Models\EmployeeEducation;
use App\Models\EmployeeLanguage;
use App\Models\Gender;
use App\Models\Language;
use App\Models\MaritalStatus;
use App\Models\NextOfKin;
use App\Models\Relation;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function startRow(): int
    {
        // start from excel row number
        return 3;
    }
    protected function get_country_id($name)
    {

        $res = Country::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_contract_id($name)
    {
        $res = Contract::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_department_id($name)
    {
        $res = Department::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_designation_id($name)
    {
        $res = Designation::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_project_id($name)
    {
        $res = Project::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_team_id($name)
    {
        $res = Team::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_office_id($name)
    {
        $res = Office::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }
    public function get_blood_group_id($name)
    {
        $res = BloodGroup::where('name', $name)->get();
        if (count($res) == 1) {
            return $res->first()->id;
        } else {
            return 0;
        }
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $emp = Employee::where('sap', $row[0])->first();
            if ($emp) {
                continue;
            } else {
                $employee = Employee::create([
                    'sap' => $row[0],
                    'first_name' => $row[1],
                    'middle_name' => $row[2],
                    'last_name' => $row[3],
                    'gender_id' =>Gender::firstOrCreate(['name'=> $row[4]])->id,
                    'marital_status_id' =>MaritalStatus::firstOrCreate(['name'=> $row[5]])->id,
                    'dob' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6])),
                    'country_id' => 110, //Kenya for now

                    'phone1' => $row[8],
                    'phone2' => $row[9],
                    'work_email' => $row[10],
                    'personal_email' => $row[11],
                    'residence' => $row[12],
                    'permanent_address' => $row[13],

                    'contract_id' => Contract::firstOrCreate(['name'=> $row[14]])->id,
                    'contract_start' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15])),
                    'contract_expiry' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[16])),
                    'department_id' =>Department::firstOrCreate(['name'=> $row[17]])->id,
                    'designation_id' =>Designation::firstOrCreate(['name'=> $row[18]])->id,
                    'project_id' => Project::firstOrCreate(['name'=> $row[19]])->id,
                    'team_id' => Team::firstOrCreate(['name' => 'General'])->id,

                    'national_id' => $row[21] ?? rand(1, 100000000),
                    'passport_number' => $row[22],
                    'huduma_number' => $row[23],
                    'kra_pin' => $row[24] ?? rand(0, 1000000),
                    'nssf' => $row[25] ?? rand(1, 1000000000),
                    'nhif' => $row[26] ?? rand(1, 10000000),

                    'bank_name' => $row[27] ?? 'na',
                    'bank_branch' => $row[28] ?? 'na',
                    'branch_code' => $row[29] ?? 'na',
                    'account_name' => $row[30] ?? 'na',
                    'account_number' => $row[31] ?? 'na',
                    'currency_id' => 1,
                    'basic_salary' => 0,

                    // 'highest_education_level'=>$row[28],

                    // 'area_of_specialization'=>$row[30],

                    'blood_group_id' =>BloodGroup::firstOrCreate(['name'=> $row[32]])->id,
                    // 'health' => $row[33],
                    'health' => (strtolower($row[33]) == 'no') ? 0 : 1,
                    'health_details' => $row[34],
                    // 'disability' => $row[35],
                    'disability' => (strtolower($row[35]) == 'no') ? 0 : 1,
                    'disability_details' => $row[36],
                ]);

                EmployeeEducation::create([
                    'education_level_id' =>
                        EducationLevel::firstOrCreate([
                            'name' => $row[37],
                        ])->id,
                    'institution' => $row[38],
                    'employee_id' => $employee->id,
                    'field_of_study' => $row[39],
                    'start_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[40])),
                    'end_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[41 ])),
                    'score' => $row[42],
                    'comments' => 'N/A',
                ]);

                NextOfKin::create([
                    'employee_id' => $employee->id,
                    'full_name' => $row[43],
                    'relationship' => $row[44],
                    'phone1' => $row[45],
                    'email' => "N/a",
                    'phone2' => 0,
                ]);
                NextOfKin::create([
                    'employee_id' => $employee->id,
                    'full_name' => $row[46],
                    'relationship' => $row[47],
                    'phone1' => $row[48],
                    'email' => "N/a",
                    'phone2' => 0,
                ]);

                //languages
                for ($i = 49; $i <= 55; $i++) {
                    if ($row[$i]) {
                        EmployeeLanguage::create([
                            'employee_id' => $employee->id,
                            'language_id' => Language::firstOrCreate(['name'=>$row[$i]])->id,
                        ]);
                    } else {
                        continue;
                    }
                }

                $user = User::make([
                    'name' => $employee->name,
                    'email' => $employee->work_email,
                    'employee_id' => $employee->id,
                ]);
                $user->password = Hash::make('TBL@2022');
                $user->save();
                // By default give Agent role
                $user->assignRole('Agent');
            }
        }
    }
}
