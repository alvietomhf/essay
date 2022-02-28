<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'title',
        'answer_key',
        'image',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
