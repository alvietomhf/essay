<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_subject_id',
        'number',
        'name',
    ];

    public function clasSubject()
    {
        return $this->belongsTo(ClasSubject::class, 'clas_subject_id');
    }
}
