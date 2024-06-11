<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Caso;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('casos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha')->useCurrent(); // La fecha se establecerá automáticamente al agregar un registro
            $table->integer('responsable')->nullable()->default(null);; // asginado a 
            $table->integer('estado'); // estado del caso 1 asignado a 2 cerrado 3 en desarrollo 4 prioritario
            $table->timestamps(); // Crea los campos created_at y updated_at automáticamente

            //campo FOREING KEY CON USUARIOS DE ASISTENCIA
            //$table->foreign('responsable')->references('id')->on('usuarios');
        });
    }

    public function down()
    {
       // Schema::dropIfExists('casos');
    }
};
