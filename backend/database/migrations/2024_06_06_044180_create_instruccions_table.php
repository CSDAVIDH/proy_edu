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
        Schema::create('instruccions', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 20);
            $table->unsignedBigInteger('docente_id');
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('paralelo_id');            
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruccions');
    }
};
