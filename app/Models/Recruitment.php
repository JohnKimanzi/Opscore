<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recruitment extends Model
{
    use HasFactory;

    protected $fillable=['id_number','phone1','phone2','email','residence','marital_status','gender',
        'country_id','level_of_education','course','work_experience','years_of_experience','area_of_experience',
        'employment_status','job_info','salary_expectation','full_name'];

    public  function  gender():BelongsTo{
        return $this->belongsTo(Gender::class);
    }
    public  function country():BelongsTo{
        return $this->belongsTo(Country::class);
    }
}
