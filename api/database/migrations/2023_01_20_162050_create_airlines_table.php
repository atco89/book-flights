<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('airlines', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uid');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(Country::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('code');
            $table->string('name');
            $table->string('image_path');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->comment('Used to store airlines.');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
