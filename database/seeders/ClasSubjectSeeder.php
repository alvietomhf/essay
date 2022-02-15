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
            'user_id' => 2,
            'color' => '#09ff00',
        ]);
        ClasSubject::create([
            'clas_id' => 2,
            'subject_id' => 1,
            'user_id' => 2,
            'color' => '#ff0800',
        ]);
        ClasSubject::create([
            'clas_id' => 3,
            'subject_id' => 1,
            'user_id' => 2,
            'color' => '#ffff00',
        ]);
        ClasSubject::create([
            'clas_id' => 4,
            'subject_id' => 1,
            'user_id' => 2,
            'color' => '#9c7c91',
        ]);
    }
}
