<?php

use App\Models\IncomeCategory;
use App\Models\IncomeSubCategory;
use App\Models\Payment;
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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('income_him');
            $table->double('amount')->default(0);
            $table->date('date')->default(now());
            $table->string('check')->nullable();
            $table->string('attach')->nullable();
            $table->string('about')->nullable();
            $table->string('notes')->nullable();
            $table->foreignIdFor(IncomeCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(IncomeSubCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Payment::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
