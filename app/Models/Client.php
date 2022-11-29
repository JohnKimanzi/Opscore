<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'name',
        'industry_id',
        'client_type',
        'physical_address',
        'phone1',
        'phone2',
        'email',
        'description',
        'contract_start',
        'contract_expiry',
        'status_id',
        'account_manager_id',
        'code',
        'country_id',
    ];
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function contact_people()
    {
        return $this->hasMany(ContactPerson::class);
    }
    public function getPrimaryContactAttribute(){
        $cont=new ContactPerson ;
        $cont=$this->contact_people()->where('description', 'primary')->get()->first();
        if($cont==null){
            $cont=$this->contact_people()->get()->first();
        }
        // dd($cont->designation);
        return $cont;
    }
    public function subscriptions(){
        return $this->morphMany(Subscription::class, 'subscribable');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
