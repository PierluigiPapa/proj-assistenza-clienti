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
        Schema::create('dettagli_conto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IDLogin');
            $table->foreign('IDLogin')->references('id')->on('login')->onDelete('cascade');
            $table->time('saldo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dettagli_conto');
    }
};
