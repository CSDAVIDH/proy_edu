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
        Schema::create('boletins', function (Blueprint $table) {
            $table->id();
            $table->float('primer'); // primer por 20%
            $table->float('segundo'); // segundo por 20%
            $table->float('modular'); // modular por 60%
            $table->float('final'); // promedio
            $table->unsignedBigInteger('nota_id');
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletins');
    }
};
