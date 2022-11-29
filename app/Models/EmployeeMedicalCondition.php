<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMedicalCondition extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'type',
        'condition',
        'description',
    ];
    public function employee()
    {
        return $this->belongsTo(Epmloyee::class);
    }
}
