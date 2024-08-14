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
        Schema::create('interventi', function (Blueprint $table) {
            $table->id();
            $table->integer('IDLogin');
            $table->unsignedBigInteger('IDNomeIntervento');
            $table->foreign('IDNomeIntervento')->references('id')->on('login')->onDelete('cascade');
            
            $table->date('data_inizio_intervento');
            $table->time('ora_inizio_intervento');
            $table->date('data_fine_intervento');
            $table->time('ora_fine_intervento');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventi');
    }
};
