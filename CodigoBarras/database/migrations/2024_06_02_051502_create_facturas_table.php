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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('idFacturas');
            $table->string('Prefijo', 45)->nullable();
            $table->string('NumFactura', 45)->nullable();
            $table->string('ValorFactura', 45)->nullable();
            $table->boolean('Terminado')->default(false);
            $table->dateTime('fechaRegistrada')->nullable();
            $table->dateTime('fechaTerminada')->nullable();
            $table->boolean('estado')->default(true);
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
        Schema::dropIfExists('facturas');
    }
};
