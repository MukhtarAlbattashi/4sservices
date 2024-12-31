<?php

use App\Models\EmployeeCategory;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->string('employeeNumber')->nullable();
            $table->date('joinDate')->nullable();
            $table->string('employeeNameAr')->nullable();
            $table->string('employeeNameEn')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('jopNameAr')->nullable();
            $table->string('jopNameEn')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('socialStatus')->nullable();
            $table->string('idNumber')->nullable();
            $table->date('dateOfIssue')->nullable();
            $table->date('expiryDate')->nullable();
            $table->string('passportNumber')->nullable();
            $table->date('passportDateOfIssue')->nullable();
            $table->date('passportExpiryDate')->nullable();
            $table->string('placeOfIssue')->nullable();
            $table->string('academicQualification')->nullable();
            $table->string('typeAcademic')->nullable();
            $table->date('dateAcademic')->nullable();
            $table->string('placeAcademic')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('notes')->nullable();
            $table->foreignIdFor(EmployeeCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
