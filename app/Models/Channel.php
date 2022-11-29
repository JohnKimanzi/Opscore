<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;

class Channel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
