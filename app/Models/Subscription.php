<?php

namespace App\Models;
use App\Models\Channel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function subscribable(){
        return $this->morphTo();
    }
    public function channel(){
        return $this->belongsTo(Channel:: class);
    }
}
