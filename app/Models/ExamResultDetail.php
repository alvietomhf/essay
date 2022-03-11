<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResultDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_result_id',
        'question_id',
        'answer',
        'similiarity_score',
    ];

    public function result()
    {
        return $this->belongsTo(ExamResult::class, 'exam_result_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
