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
        Schema::create('administrativos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo',45);
            $table->string('grado',45);
            $table->string('cv',45);
            $table->tinyInteger('estado')->default(1);
            $table->unsignedBigInteger('persona_id'); 
    
            $table->timestamps();
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
 
        });
    }

    
    public function down():void
    {
        Schema::table('administrativos', function (Blueprint $table) {
        
            $table->dropForeign(['persona_id']);
        });
        
        Schema::dropIfExists('administrativos');
    }
};
