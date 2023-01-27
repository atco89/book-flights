<?php

use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uid');
            $table->timestamps();
            $table->softDeletes();

            $table->string('flight_iata');
            $table->string('flight_number');
            $table->foreignIdFor(Airline::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignIdFor(Aircraft::class)
                ->constrained('aircrafts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignIdFor(Airport::class, 'dep_airport_id')
                ->constrained('airports')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->time('dep_time');
            $table->foreignIdFor(Airport::class, 'arr_airport_id')
                ->constrained('airports')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->time('arr_time');
            $table->unsignedInteger('duration');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->comment('Used to store flights.');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
