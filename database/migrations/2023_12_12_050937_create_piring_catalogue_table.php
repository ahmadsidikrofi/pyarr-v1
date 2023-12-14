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
        Schema::create('piring_catalogue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('piring_catalogue_id')->nullable();
            $table->string('nama_piring');
            $table->string('slug', 255)->nullable();
            $table->string('deskripsi_piring');
            $table->integer('harga_sewa')->default(5000);
            $table->string('image')->nullable();
            $table->string('status')->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piring_catalogue');
    }
};
