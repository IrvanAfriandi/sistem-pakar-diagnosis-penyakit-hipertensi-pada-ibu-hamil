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
        Schema::create('detail_konsultasi', function (Blueprint $table) {
            $table->id('id_detail_konsultasi');
            $table->unsignedBigInteger('id_konsultasi')->nullable();
            $table->unsignedBigInteger('id_gejala')->nullable();
            $table->double('cf_pasien', 8, 2)->nullable();

            $table->foreign('id_konsultasi')->references('id_konsultasi')->on('konsultasi')->onDelete('set null');
            $table->foreign('id_gejala')->references('id_gejala')->on('gejala')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_konsultasi');
    }
};
