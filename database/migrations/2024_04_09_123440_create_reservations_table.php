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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date_start')->format('Y-m-d');
            $table->date('date_end')->format('Y-m-d');
            $table
                ->foreignId('reserved_car_id')
                ->constrained('cars', 'id')
                ->onDelete('cascade');
            $table
                ->foreignId('uid')
                ->nullable()
                ->constrained('users', 'id')
                ->onDelete('cascade');
            $table->integer('total_cost');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
