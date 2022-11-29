<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'sap',
        // 'tenure',
        // 'contract_start',
        // 'project_id',
        // 'designation_id',
        // 'project_type_id',
        // 'leave_balance_id',
        'employee_id',
        'leave_category_id',
        'status',
        'start_date',
        'end_date',
        'leave_days',
        'reason',
        'num_days',
        'approved_by_id',
        'comments',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    //    'leave_days',
        'deleted_at'
    ];

    protected $casts = [
        'leave_days'=>'array'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function approved_by()
    {
        return $this->belongsTo(User::class, 'approved_by_id');
    }

    public function cat()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_category_id');
    }
    public function leave_category()
    {
        return $this->belongsTo(LeaveCategory::class);
    }
    public function statuses()
    {
        return $this->hasMany(Status::class, 'status_id');
    }
    public function getBalanceAttribute(){
        $bal = LeaveBalance::where('leave_category_id', $this->cat->id)
            ->where('record_year', now()->format('Y'))
            ->where('employee_id', $this->employee_id)
            ->first();
        return $bal;
    }
}

