<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentiRicaricaTable extends Migration
{
    public function up()
    {
        Schema::create('movimenti_ricarica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IDOpzioneRicarica');
            $table->unsignedBigInteger('IDLogin');
            $table->dateTime('data');
            $table->time('ore');
            $table->string('paypal_orderid', 120);
            $table->timestamps();

            $table->foreign('IDOpzioneRicarica')->references('id')->on('opzioni_ricarica')->onDelete('cascade');
            $table->foreign('IDLogin')->references('id')->on('login')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimenti_ricarica');
    }
}
