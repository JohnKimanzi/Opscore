<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BloodGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rhesus',
        'description',
    ];

    public  function  employee():HasMany{
        return  $this->hasMany(Employee::class);
    }
}
