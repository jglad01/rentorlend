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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table
                ->foreignId('uid')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('production_year');
            $table->integer('mileage');
            $table->string('transmission');
            $table->string('fuel');
            $table->string('photos');
            $table->integer('fuel_usage');
            $table->string('type');
            $table->string('make');
            $table->string('model');
            $table->string('location');
            $table->integer('price');
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
