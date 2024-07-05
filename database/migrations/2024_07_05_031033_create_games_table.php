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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('urutan_hilir');
            $table->foreignId('lap_id')->references('id')->on('laps');
            $table->foreignId('lottery_id')->references('id')->on('lotteries');
            $table->unsignedBigInteger('jalur_kiri')->nullable();
            $table->unsignedBigInteger('jalur_kanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};