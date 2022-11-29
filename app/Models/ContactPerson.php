<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class ContactPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'email',
        'physical_address',
        'phone1',
        'phone2',
        'designation',
        'description',
    ];
    public function Company(){
        return $this->belongsTo(Client::class);
    }
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
