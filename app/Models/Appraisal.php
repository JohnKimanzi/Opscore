<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum as sum;

class Appraisal extends Model
{
    use HasFactory;

    protected $fillable = [
        'appraiser_id',
        'employee_id',
        'status',
        'record_year'
    ];

    public function section_d():HasMany
    {
        return $this->hasMany(AppraisalSectionD::class);
    }

    public function section_results():HasMany
    {
        return $this->hasMany(AppraisalSectionResults::class);
    }

    public function appraiser():BelongsTo{
        return $this->belongsTo(Employee::class,'appraiser_id','id');
    }

    public function appraisee():BelongsTo{
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
    public function employee():BelongsTo{
        return $this->belongsTo(Employee::class);
    }

    public function getScoresAttribute()
    {
        $section_A=10;
        $section_B=10;
        $section_C=10;
        $section_D=10;
        $overall=null;

        // some code here

        $overall=$section_A + $section_B + $section_C + $section_C + $section_D;
        $scores=[
            'section_A'=>$section_A,
            'section_B'=>$section_B,
            'section_C'=>$section_C,
            'section_D'=>$section_D,
            'overall'=>$overall,
        ];
        return $scores;
    }
}
