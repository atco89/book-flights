<?php

use App\Models\Flight;
use App\Models\TravelClass;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('flight_tickets', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uid');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Flight::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignIdFor(TravelClass::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->unsignedInteger('capacity');
            $table->unsignedDecimal('price');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->comment('Used to store flight tickets.');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_tickets');
    }
};
