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

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }
}
