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
        Schema::create('padres', function (Blueprint $table) {
            $table->id();
            $table->string('profesion', 250);
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('persona_id');

            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padres');
    }
};
