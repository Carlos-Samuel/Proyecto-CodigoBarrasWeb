<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('casoProceso', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha')->useCurrent(); // La fecha se establecerá automáticamente al agregar un registro
            //$table->integer('id_caso');
            $table->timestamps(); // Crea los campos created_at y updated_at automáticamente

            //campo FOREING KEY con id de casos
            $table->foreignId('id_caso')->references('id')->on('casos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
