<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_subject_id',
        'title',
        'slug',
        'description',
        'code',
        'is_active',
        'mix_question',
    ];

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M');
    }

    public function clasSubject()
    {
        return $this->belongsTo(ClasSubject::class, 'clas_subject_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
