<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeasonIdToClasSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clas_subjects', function (Blueprint $table) {
            $table->foreignId('season_id')->after('subject_id')->constrained('seasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clas_subjects', function (Blueprint $table) {
            $table->dropColumn('season_id');
        });
    }
}
