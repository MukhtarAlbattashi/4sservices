<?php

use App\Models\Employee;
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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contractName')->nullable();
            $table->string('jobNameAr')->nullable();
            $table->string('jobNameEn')->nullable();
            $table->string('contractDuration')->nullable();
            $table->string('startDateContract')->nullable();
            $table->string('endDateContract')->nullable();
            $table->string('dateContract')->nullable();
            $table->string('basicSalary')->nullable();
            $table->string('costOfLivingAllowance')->nullable();
            $table->string('foodAllowance')->nullable();
            $table->string('transferAllowance')->nullable();
            $table->string('overtime')->nullable();
            $table->string('housingAllowance')->nullable();
            $table->string('phoneAllowance')->nullable();
            $table->string('otherAllowance')->nullable();
            $table->string('medical')->nullable();
            $table->string('socialInsuranceDiscount')->nullable();
            $table->string('totalSalary')->nullable();
            $table->string('contractTermsAr')->nullable();
            $table->string('contractTermsEn')->nullable();
            $table->string('notes')->nullable();
            $table->foreignIdFor(Employee::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
