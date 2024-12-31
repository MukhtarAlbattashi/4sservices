<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('traineeAr')->nullable();
            $table->string('traineeEn')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('idNumber')->nullable();
            $table->string('jobName')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('status')->nullable();
            $table->string('address')->nullable();
            $table->string('academicQualification')->nullable();
            $table->string('typeAcademic')->nullable();
            $table->date('dateAcademic')->nullable();
            $table->string('placeAcademic')->nullable();
            $table->string('trainingDepartment')->nullable();
            $table->string('trainingDuration')->nullable();
            $table->string('trainingSalary')->nullable();
            $table->date('startTrainingDate')->nullable();
            $table->date('endTrainingDate')->nullable();
            $table->string('trainingPlace')->nullable();
            $table->string('attendTraining')->nullable();
            $table->string('managementSkills')->nullable();
            $table->string('technicalSkills')->nullable();
            $table->string('evaluationTrainee')->nullable();
            $table->string('image')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainees');
    }
};
