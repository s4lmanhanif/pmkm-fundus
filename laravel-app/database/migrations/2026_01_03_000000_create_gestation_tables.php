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
        Schema::create('mother', function (Blueprint $table) {
            $table->id('mother_id');
            $table->string('mother_name', 120);
            $table->text('mother_address')->nullable();
            $table->tinyInteger('mother_etnis')->default(0);
            $table->tinyInteger('mother_parity')->default(0);
            $table->float('mother_weight')->default(0);
            $table->float('mother_height')->default(0);
            $table->timestamps();
        });

        Schema::create('embrio', function (Blueprint $table) {
            $table->id('embrio_id');
            $table->foreignId('embrio_mother_id')->constrained('mother', 'mother_id')->cascadeOnDelete();
            $table->date('embrio_edd')->nullable();
            $table->tinyInteger('embrio_sex')->default(-1);
            $table->timestamps();
        });

        Schema::create('measurement', function (Blueprint $table) {
            $table->id('measurement_id');
            $table->foreignId('measurement_embrio_id')->constrained('embrio', 'embrio_id')->cascadeOnDelete();
            $table->date('measurement_date');
            $table->float('measurement_height')->default(0);
            $table->timestamps();
            $table->index('measurement_embrio_id', 'idx_measurement_embrio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurement');
        Schema::dropIfExists('embrio');
        Schema::dropIfExists('mother');
    }
};
