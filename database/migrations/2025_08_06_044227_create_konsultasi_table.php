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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->unsignedBigInteger('id_pasien')->nullable();
            $table->date('tanggal');
            $table->string('hasil_diagnosa')->nullable();
            $table->double('tingkat_keyakinan', 8, 2)->nullable();

            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
