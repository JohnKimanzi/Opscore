<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['title','body','posted_by','channel_id', 'status'];

    public function channel()
    {
       return $this->belongsTo(Channel::class);
    }
}
