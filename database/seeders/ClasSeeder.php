<?php

namespace Database\Seeders;

use App\Models\Clas;
use Illuminate\Database\Seeder;

class ClasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clas::create(['name' => 'XI IPA 1']);
        Clas::create(['name' => 'XI IPA 2']);
        Clas::create(['name' => 'XI IPS 1']);
        Clas::create(['name' => 'XI IPS 2']);
    }
}
