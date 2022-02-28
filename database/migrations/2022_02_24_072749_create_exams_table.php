<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clas_subject_id')->constrained('clas_subjects')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('code')->unique();
            $table->boolean('is_active')->default(0);
            $table->boolean('mix_question')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
