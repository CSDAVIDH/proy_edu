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
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',90);
            $table->string('sigla',90);
            $table->integer('porcentaje');
            $table->tinyInteger('tipo'); // 1 materia - 2 formacion - 3 desquite
            $table->integer('horas_cademicas');
            $table->tinyInteger('estado')->default(1); // 0 eliminado - 1 activo
            
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('especialidad_id')->nullable();
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};
