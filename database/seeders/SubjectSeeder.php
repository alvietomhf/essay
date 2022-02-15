<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['name' => 'TIK']);
        Subject::create(['name' => 'Matematika']);
        Subject::create(['name' => 'Fisika']);
        Subject::create(['name' => 'Biologi']);
    }
}
