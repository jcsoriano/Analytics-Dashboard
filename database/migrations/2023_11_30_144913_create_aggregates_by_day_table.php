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
        Schema::create('aggregates_by_day', function (Blueprint $table) {
            $table->id();
            $table->date('aggregate_at');
            $table->foreignId('device_type_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->integer('total');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aggregates_by_day');
    }
};
