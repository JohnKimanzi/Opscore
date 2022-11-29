<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'name',
        'description',
    ];
    public function members()
    {
        return $this->hasMany(Employee::class);
    }
    public function leaves()
    {
        return $this->hasManyThrough(Leave::class, Employee::class);
    }
    public function attendance()
    {
        return $this->hasManyThrough(Attendance::class, Employee::class);
    }
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, Employee::class);
    }
    // public function leader()
    // {
    //     return $this->belongsTo(Employee::class , 'leader_id');
    // }
    public function leads()
    {
        return $this->HasMany(TeamLead::class , 'team_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function subscriptions(){
        return $this->morphMany(Subscription::class, 'subscribable');
    }
    public function getTeamLeadersAttribute(){

    }

}
