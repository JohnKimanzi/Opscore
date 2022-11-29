<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'language_id',
    ];

    public  function employee():BelongsTo{
        return $this->belongsTo(Employee::class);
    }
    public  function  language():BelongsTo{
        return $this->belongsTo(Language::class);
    }
    public  static  function  recordLanguage($languages,$employee){
        foreach (json_decode($languages,true) as $item){
            EmployeeLanguage::create([
                'employee_id'=>$employee,
                'language_id'=>$item['id']
            ]);
        }
    }
}
