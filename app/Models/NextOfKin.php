<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NextOfKin extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'relationship',
        'id_number',
        'full_name',
        'email',
        'phone1',
        'phone2',

    ];
    public function employee():BelongsTo
    {
    return $this->belongsTo(Employee::class);
    }
    public static  function recordNextOfKin($kins,$employee){

        foreach (json_decode($kins,true) as  $item) {

            $kin = NextOfKin::create([
                'employee_id'=>$employee,
                'relationship'=>$item['nextOfKinRelationship'],
                // 'id_number'=>$request->id_number,
                'full_name'=>$item['nextOfKinFullName'],
                'phone1'=>$item['nextOfKinPhone'],
            ]);

        }
    }
}
