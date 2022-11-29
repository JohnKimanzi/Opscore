<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable= [
        'record_date',
        'team_leader',
        'employee_id',
        'status',
        'comments',
        
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
