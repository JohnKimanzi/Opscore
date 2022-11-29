<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'document_type_id', 'size', 'url',  'uploaded_by_id','documentable_id', 'documentable_type'];

    public function documentable()
    {
        return $this->morphTo();
    }
}
