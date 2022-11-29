<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AppraisalSectionResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'appraisal_id',
        'employee_id',
        'appraiser_id',
        'resultable_type',
        'resultable_id',
        'target_performance',
        'actual_performance',
        'employee_rating',
        'employee_remarks',
        'appraiser_rating',
        'appraiser_remarks',
        'overall_rating'
    ];

    public function resultable():MorphTo
    {
        return $this->morphTo();
    }

    public function appraisal():BelongsTo
    {
        return $this->belongsTo(Appraisal::class);
    }
    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
