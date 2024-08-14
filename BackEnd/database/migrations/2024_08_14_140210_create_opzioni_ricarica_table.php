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
        Schema::create('opzioni_ricarica', function (Blueprint $table) {
            $table->id();

            $table->string('descrizione', 50);
            $table->decimal('costo', 10, 2);
            $table->time('ore');
            $table->tinyInteger('admin')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opzioni_ricarica');
    }
};
