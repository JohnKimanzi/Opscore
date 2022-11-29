<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'client_id',
        'code',
        'project_type_id',
        'delivery_type_id',
        'description',
        'status_id',
        'billing_type_id',
        'billing_frequency_id',
        'service_type_id',
        'currency_id',
        'pricing',
        'start_date',
        'end_date',
    ];
    // public  function  documents(): HasMany
    // {
    //     return $this->hasMany(ProjectDocuments::class);
    // }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    public function project_type()
    {
        return $this->belongsTo(ProjectType::class);
    }
    // public function projectTypes()
    // {
    //     return $this->belongsToMany(ProjectType::class, 'project_type_name', 'project_type_id');
    // }
    public function billingType(): BelongsTo
    {
        return $this->belongsTo(BillingType::class);
    }
    public function billingFrequency(): BelongsTo
    {
        return $this->belongsTo(BillingFrequency::class);
    }
    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
    public function subscriptions(){
        return $this->morphMany(Subscription::class, 'subscribable');
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
    public function attendances()
    {
        return $this->hasManyThrough(Attendance::class, Employee::class);
    }
}
