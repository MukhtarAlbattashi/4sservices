<?php

use App\Models\AllowanceCategory;
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
        Schema::create('allowances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('amount')->default(0);
            $table->date('date')->default(now());
            $table->string('notes')->nullable();
            $table->foreignIdFor(Employee::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(AllowanceCategory::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowances');
    }
};
