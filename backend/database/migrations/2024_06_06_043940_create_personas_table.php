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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',45);
            $table->string('paterno',45);
            $table->string('materno',45);
            $table->string('ci',45);
            $table->string('expedido',45);
            $table->string('estado_civil');
            $table->string('genero');
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('user_id'); 
          
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down():void
    {
        Schema::table('personas', function (Blueprint $table) {
        
            $table->dropForeign(['usuario_id']);
        });
        
        Schema::dropIfExists('personas');
    }
};
