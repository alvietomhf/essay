<?php

namespace App\Observers;

use App\Models\Clas;
use App\Models\ClasSubject;

class ClasObserver
{
    public function updated(Clas $clas)
    {
        if ($clas->wasChanged('name')) {
            ClasSubject::where('clas_id', $clas->id)->update(['cname' => $clas->name]);
        } 
    }
}
