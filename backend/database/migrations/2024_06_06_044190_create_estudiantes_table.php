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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('matricula',45)->unique();
            $table->date('fecha_alta');
            $table->integer('nota_ingreso')->default(0);
            $table->date('fecha_baja')->nullable();
            $table->tinyInteger('reincidencia')->default(0); // maximo 3 veces
            $table->tinyInteger('observacion')->default(0); // 0 ingreso - 1 inscrito - 2 aprobado - 3 reprobado - 4 egresado
            $table->tinyInteger('estado')->default(1);// 0 baja - 1 alta
            $table->unsignedBigInteger('persona_id'); 
            $table->unsignedBigInteger('grado_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->foreign('grado_id')->references('id')->on('grados')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
    
            $table->timestamps();
 
           
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down():void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
        
            $table->dropForeign(['persona_id']);
        });
        
        Schema::dropIfExists('estudiantes');
    }
};
