<?php

use App\Models\Car;
use App\Models\Customer;
use App\Models\JobCard;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->uuid('uuid')->unique();
            $table->double('services_total')->default(0);
            $table->double('parts_total')->default(0);
            $table->double('tax')->default(0);
            $table->double('discount')->default(0);
            $table->double('total')->default(0);
            $table->date('date')->default(now());
            $table->boolean('is_paid')->default(false);
            $table->foreignIdFor(Car::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(JobCard::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
