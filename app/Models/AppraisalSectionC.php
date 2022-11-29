<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class AppraisalSectionC extends Model
{
    use HasFactory;

    protected $table = 'appraisal_section_c_s';

    public function results():MorphMany
    {
        return $this->morphMany(AppraisalSectionResult::class, 'resultable');
    }
}
