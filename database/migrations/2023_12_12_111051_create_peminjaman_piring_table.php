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
        Schema::create('peminjaman_piring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id')->nullable();
            $table->unsignedBigInteger('piring_catalogue_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status')->default("Tersedia");
            $table->date('rent_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_piring');
    }
};
