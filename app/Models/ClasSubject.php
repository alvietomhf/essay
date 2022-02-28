<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_id',
        'subject_id',
        'season_id',
        'user_id',
        'color',
    ];

    public function clas()
    {
        return $this->belongsTo(Clas::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
