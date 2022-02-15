<?php

namespace App\Http\Controllers;

use App\Models\ClasSubject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        return view('dashboard.admin');
    }

    public function dashboardTeacher()
    {
        $kelasMapel = ClasSubject::where('user_id', auth()->user()->id)
                        ->with([
                            'clas',
                            'subject',
                        ])
                        ->get();
        $kelasMapelCount = ClasSubject::where('user_id', auth()->user()->id)->count();
    
        return view('dashboard.teacher', compact('kelasMapel', 'kelasMapelCount'));
    }
}
