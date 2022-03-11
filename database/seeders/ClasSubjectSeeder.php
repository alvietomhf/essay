<?php

namespace Database\Seeders;

use App\Models\Clas;
use App\Models\ClasSubject;
use Illuminate\Database\Seeder;

class ClasSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClasSubject::create([
            'clas_id' => 1,
            'cname' => Clas::find(1)->name,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#EAC4D5',
        ]);
        ClasSubject::create([
            'clas_id' => 2,
            'cname' => Clas::find(2)->name,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#FFC09F',
        ]);
        ClasSubject::create([
            'clas_id' => 3,
            'cname' => Clas::find(3)->name,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#FFEE93',
        ]);
        ClasSubject::create([
            'clas_id' => 4,
            'cname' => Clas::find(4)->name,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#33CC99',
        ]);
    }
}
