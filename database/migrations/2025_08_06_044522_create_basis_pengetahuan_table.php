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
        Schema::create('basis_pengetahuan', function (Blueprint $table) {
            $table->id('id_pengetahuan');
            $table->unsignedBigInteger('id_penyakit')->nullable();
            $table->unsignedBigInteger('id_gejala')->nullable();
            $table->double('cf_pakar', 8, 2)->nullable();

            $table->foreign('id_penyakit')->references('id_penyakit')->on('penyakit')->onDelete('set null');
            $table->foreign('id_gejala')->references('id_gejala')->on('gejala')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basis_pengetahuan');
    }
};
