<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeEducation extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'institution',
        'education_level_id',
        'field_of_study',
        'start_date',
        'end_date',
        'comments',
    ];
    protected $dates = ['start_date', 'end_date'];
    public function employee():BelongsTo
    {
    return $this->belongsTo(Employee::class);
    }
    public function level():BelongsTo
    {
        return $this->belongsTo(EducationLevel::class,'education_level_id');
    }
    public  static  function recordEducation($educations,$employee){
        foreach (json_decode($educations,true) as $item){
            EmployeeEducation::create([
                'employee_id'=>$employee,
                'education_level_id'=>$item['educationLevel'],
                'institution'=>$item['educationInstitution'],
                'field_of_study'=>$item['educationFieldOfStudy'],
                'start_date'=>$item['educationStart'],
                'end_date'=>$item['educationEnd'],
            ]);
        }
    }
}
