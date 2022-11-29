<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'employee_id',
        'position',
        'start_date',
        'end_date',
        'reason_for_leaving',
        'duties_performed',
    ];
}
