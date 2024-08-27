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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('grado',45);
            $table->string('especialidad',45);
            $table->string('cv');
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('persona_id'); 
    
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     */
  

    public function down():void
    {
        Schema::table('docentes', function (Blueprint $table) {
        
            $table->dropForeign(['persona_id']);
        });
        
        Schema::dropIfExists('docentes');
    }
};
