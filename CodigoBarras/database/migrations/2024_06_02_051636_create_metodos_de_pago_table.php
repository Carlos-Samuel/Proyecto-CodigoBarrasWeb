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
        Schema::create('metodos_de_pago', function (Blueprint $table) {
            $table->id('idMetodos_de_pago');
            $table->string('Descripcion', 45)->nullable();
            $table->string('Cuenta', 45)->nullable();
            $table->string('Imagen', 150)->nullable();
            $table->boolean('Activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metodos_de_pago');
    }
};
