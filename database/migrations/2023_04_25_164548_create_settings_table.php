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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('stamp')->nullable();
            $table->string('logo')->nullable();
            $table->string('header')->nullable();
            $table->string('companyNameAr')->nullable();
            $table->string('companyNameEn')->nullable();
            $table->string('CRNo')->nullable();
            $table->string('addressAr')->nullable();
            $table->string('addressEn')->nullable();
            $table->string('governorateAr')->nullable();
            $table->string('governorateEn')->nullable();
            $table->string('wilayatAr')->nullable();
            $table->string('wilayatEn')->nullable();
            $table->string('buildingNo')->nullable();
            $table->string('POBox')->nullable();
            $table->string('pc')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->double('tax')->nullable();
            $table->string('taxNumber')->nullable();
            $table->string('termsAr')->nullable();
            $table->string('termsEn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
