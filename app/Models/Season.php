<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function clasSubjects()
    {
        return $this->hasMany(ClasSubject::class)->where('user_id', auth()->user()->id);
    }
}
