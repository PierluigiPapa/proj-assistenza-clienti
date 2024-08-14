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
        Schema::create('tipi_intervento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intervento_id');
            $table->string('tipologia', 255);
            $table->string('dettagli', 255);
            $table->timestamps();

            $table->foreign('intervento_id')->references('id')->on('interventi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipi_intervento');
    }
};
