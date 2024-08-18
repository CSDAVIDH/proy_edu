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
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->tinyInteger('periodo'); // 1 PRIMERA GESTION -  2 II SEGUNDA GESTON
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('paralelo_id');            
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');
            $table->foreign('paralelo_id')->references('id')->on('paralelos')->onDelete('cascade');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscritos');
    }
};
