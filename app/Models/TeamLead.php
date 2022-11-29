<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamLead extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['employee_id', 'team_id'];
    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
