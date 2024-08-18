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
        Schema::create('paralelos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 90);
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');
            $table->tinyInteger('estado')->default(1);
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paralelos');
    }
};
