<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraiser extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
    ];

    public function appraisals()
    {
        return $this->hasMany(Appraisal::class);
    }
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
