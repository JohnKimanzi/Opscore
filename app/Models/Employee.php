<?php

namespace App\Models;

use Carbon\Carbon;
use CreateEmployeeExperiencesTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use HasRoles;
    use SoftDeletes;
    protected $dates = ['deleted_at', 'dob', 'contract_expiry', 'contract_start'];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'other_names'
    ];

    protected $guard_name = 'web';
    public $fillable = [
        'sap',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'gender_id',
        'marital_status_id',
        'country_id',
        'phone1',
        'phone2',
        'language1',
        'language2',
        'language3',
        'language4',
        'language5',
        'work_email',
        'personal_email',
        // 'personal_email2',
        'residence',
        'permanent_address',
        'date_hired',
        'basic_salary',
        'currency_id',
        'contract_id',
        'contract_start',
        'contract_expiry',
        'department_id',
        'designation_id',
        'project_id',
        'team_id',
        'passport_number',
        'huduma_number',
        'national_id',
        'kra_pin',
        'nssf',
        'nhif',
        'bank_name',
        'branch_code',
        'bank_branch',
        'account_name',
        'account_number',
        'blood_group_id',
        'disability',
        'disability_details',
        'health',
        'health_details',
        'employee_status_id',
        'attri_type',
        'attri_reason'
    ];


    public  function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id');
    }
    public function appraisals(): HasMany
    {
        return $this->hasMany(Appraisal::class);
    }
    public  function  employeeStatus(): BelongsTo
    {
        return $this->belongsTo(EmployeeStatus::class);
    }
    public  function employeeLanguages(): HasMany
    {
        return $this->hasMany(EmployeeLanguage::class);
    }

    #using m-m relationships
    public  function languages()
    {
        return $this->belongsToMany(Language::class, 'employee_languages', 'employee_id', 'language_id')->withTimestamps();
    }

    public function getAppraiserAttribute()
    {
        return $this->team->leads->first()->employee;
    }

    public function getAppraiseesAttribute()
    {
        return $this->teams_i_can_manage->flatMap->members;
    }

    public function medical_conditions(): HasMany
    {
        return $this->hasMany(EmployeeMedicalCondition::class);
    }
    public function appraisalResult(): HasMany
    {
        return $this->hasMany(AppraisalSectionResult::class);
    }
    public function educations(): HasMany
    {
        return $this->hasMany(EmployeeEducation::class);
    }
    public function experiences(): HasMany
    {
        return $this->hasMany(EmployeeExperience::class);
    }
    public function nextOfKins(): HasMany
    {
        return $this->hasMany(NextOfKin::class);
    }
    public function project_type(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
    public function team_leads(): HasMany
    {
        return $this->hasMany(TeamLead::class);
    }
    public function getTeamsICanManageAttribute()
    {
        $res = $this->team_leads->map->team;
        return $res;
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function leave_balances()
    {
        return $this->hasMany(LeaveBalance::class);
    }
    // public function getLeaveBalForYear($year)
    // {
    //     return $this->leave_balances()->where('record_year', $year)->first();
    // }

    public  function  disabilityStatus(): BelongsTo
    {
        return  $this->belongsTo(DisabilityStatus::class, 'disability');
    }

    public  function  currency(): BelongsTo
    {
        return  $this->belongsTo(Currency::class, 'currency_id');
    }
    public  function  marital_status(): BelongsTo
    {
        return  $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }
    public  function  gender(): BelongsTo
    {
        return  $this->belongsTo(Gender::class, 'gender_id');
    }

    public  function  healthStatus(): BelongsTo
    {
        return  $this->belongsTo(HealthStatus::class, 'health');
    }
    public  function  status(): BelongsTo
    {
        return  $this->belongsTo(EmployeeStatus::class, 'status_id');
    }

    public function getAttendanceDuring($start_date, $end_date)
    {
        // dd(date('Y-m-d', strtotime($start_date->copy()->startOfDay())));
        return $this->attendances
            ->where('record_date', '>', $start_date)
            ->where('record_date', '<', $end_date);
        //  ->where('record_date', '<', $end_date->copy()->endOfDay());
        // ->pluck('status', 'created_at');
    }

    public function getOtherNamesAttribute()
    {
        return "{$this->middle_name} {$this->last_name}";
    }
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }

    public function getIsTeamLeadAttribute()
    {
        if (TeamLead::whereIn('employee_id', [$this->id])->count()) {
            return true;
        } else return false;
    }
    // using this in place of a propper organization structure
    public function getSupervisorAttribute()
    {
        return $this->team->leads->first()->employee;
    }
}
