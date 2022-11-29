<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeaveCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'days',
        'max_carry_forward',
        'description',
    ];
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function employees()
    {
        return $this->hasManyThrough(Employee::class, Leave::class);
    }
    public  function leave_balances():HasMany{
        return $this->hasMany(LeaveBalance::class);
    }
}
