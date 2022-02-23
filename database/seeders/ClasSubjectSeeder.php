<?php

namespace Database\Seeders;

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
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#EAC4D5',
        ]);
        ClasSubject::create([
            'clas_id' => 2,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#FFC09F',
        ]);
        ClasSubject::create([
            'clas_id' => 3,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#FFEE93',
        ]);
        ClasSubject::create([
            'clas_id' => 4,
            'subject_id' => 1,
            'season_id' => 1,
            'user_id' => 2,
            'color' => '#33CC99',
        ]);
    }
}
