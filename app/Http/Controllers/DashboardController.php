<?php

namespace App\Http\Controllers;

use App\Models\ClasSubject;
use App\Models\Season;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {
        return view('dashboard.admin');
    }

    public function dashboardTeacher()
    {
        $data = Season::with(['clasSubjects' => function ($q) {
                                    $q->with([
                                        'clas',
                                        'subject'
                                    ]);
                                }])
                                ->withCount(['clasSubjects'])
                                ->get();

        $kelasMapelCount = ClasSubject::where('user_id', auth()->user()->id)->count();
    
        return view('dashboard.teacher', compact('data', 'kelasMapelCount'));
    }
}
