<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'employee_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function projects ()
    {
        return $this->hasMany(Project::class);
    }
    public function subscriptions(){
        return $this->morphMany(Subscription::class, 'subscribable');
    }
    public function getAnnouncementsAttribute(){
        $an =collect();
        //  collect(array(
            // dd($this->id);
            $this->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements));
            ($this->employee->department) ? $this->employee->department->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements)) : [];
            ($this->employee->designation) ? $this->employee->designation->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements)) : [];
            ($this->employee->team) ? $this->employee->team->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements)) : [];
            ($this->client) ? $this->client->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements)) : [];
            ($this->employee->project) ? $this->employee->project->subscriptions->each(fn($sub)=>$an->push($sub->channel->announcements)) : [];
        // ));

        $res=$an->first() ?? collect();
        return $res->unique();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function gender ()
    {
        return $this->employee->gender;
    }
}
