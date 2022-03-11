<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_id',
        'number',
        'name',
    ];

    public function clas()
    {
        return $this->belongsTo(Clas::class, 'clas_id');
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
}
