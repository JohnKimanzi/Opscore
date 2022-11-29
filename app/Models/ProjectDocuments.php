<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectDocuments extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at'];

    protected  $fillable=['project_id','name','size','uploaded_by_id'];

    public  function  project():BelongsTo{
        return $this->belongsTo(Project::class);
    }
    public function uploaded_by(){
        return $this->belongsTo(User::class);
    }

    public function document_types()
    {
        return $this->hasMany(DocumentType::class);
    }
}
