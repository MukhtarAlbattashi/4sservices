<?php

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Customer;
use App\Models\RegistrationType;
use App\Models\User;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('owner_id')->nullable();
            $table->string('number');
            $table->string('letter');
            $table->string('color');
            $table->string('year');
            $table->string('chassis');
            $table->string('cylinders');
            $table->string('attach')->nullable();
            $table->string('other')->nullable();
            $table->string('notes')->nullable();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarBrand::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarModel::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(RegistrationType::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
