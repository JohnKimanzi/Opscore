<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AppraisalSectionD extends Model
{
    use HasFactory;

    protected $fillable = [
        'appraisal_id',
        'strengths_appraisee_remarks',
        'strengths_appraiser_remarks',
        'development_areas_appraisee_remarks',
        'development_areas_appraiser_remarks',
        'trainings_undertaken',
        'self_learning',
        'comments',
        'reccommended_actions',
        'action_timelines',
        'support_required',
    ];

    protected $table = 'appraisal_section_d';

    public function results():MorphMany
    {
        return $this->morphMany(AppraisalSectionResult::class, 'resultable');
    }


}
