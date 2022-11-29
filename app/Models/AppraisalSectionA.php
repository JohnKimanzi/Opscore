<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AppraisalSectionA extends Model
{
    use HasFactory;

    protected $fillable = [
        'KRA',
        'KPI',
        'weightage'
    ];

    protected $table = 'appraisal_section_a';

    public function results():MorphMany
    {
        return $this->morphMany(AppraisalSectionResult::class, 'resultable');
    }

}
