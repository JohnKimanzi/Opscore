<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'consumed',
        'leave_category_id',
        'record_year',
        'balance',
        'carried_forward'
    ];
    public function employees(){
        return $this->belongsTo(Employee::class);
    }
    public  function leaveType():BelongsTo{
        return $this->belongsTo(LeaveCategory::class);
    }
    public  function leave_category():BelongsTo{
        return $this->belongsTo(LeaveCategory::class);
    }
}
