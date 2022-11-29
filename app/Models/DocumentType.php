<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function project_docs()
    {
        return $this->belongsToMany(ProjectDocuments::class);
    }
}