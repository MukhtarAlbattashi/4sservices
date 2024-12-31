<?php

use App\Models\Car;
use App\Models\Customer;
use App\Models\JopStatus;
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
        Schema::create('job_cards', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->date('dateEntry')->default(date('Y-m-d', strtotime(now())));
            $table->time('timeEntry')->default(now()->addHours(4)->format('H:i'));
            $table->string('whereTheCarCame')->nullable();
            $table->string('carDriverWhereTheCarCame')->nullable();
            $table->string('entryCounterNumber')->nullable();
            $table->string('carRepairPermission')->nullable();
            $table->string('entryImage')->nullable();
            $table->mediumText('paintWorks')->nullable();
            $table->mediumText('dentingWorks')->nullable();
            $table->mediumText('electricalWorks')->nullable();
            $table->mediumText('mechanicWorks')->nullable();
            $table->mediumText('StatusCarOfEntry')->nullable();
            $table->mediumText('StatusCarOfExit')->nullable();
            $table->date('dateExit')->default(date('Y-m-d', strtotime(now())));
            $table->time('timeExit')->default(now()->addHours(4)->format('H:i'));
            $table->string('departureDestination')->nullable();
            $table->string('carDriverDeparture')->nullable();
            $table->string('exitCounterNumber')->nullable();
            $table->string('exitImage')->nullable();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Car::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(JopStatus::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('job_cards');
    }
};
