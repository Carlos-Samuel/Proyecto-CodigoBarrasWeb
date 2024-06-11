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
        Schema::create('pagos_facturas', function (Blueprint $table) {
            $table->unsignedBigInteger('Facturas_idFacturas');
            $table->unsignedBigInteger('Metodos_de_pago_idMetodos_de_pago');
            $table->integer('Cantidad')->nullable();
            $table->unsignedBigInteger('Usuarios_idUsuarios');

            $table->primary(['Facturas_idFacturas', 'Metodos_de_pago_idMetodos_de_pago']);

            // Foreign keys
            $table->foreign('Facturas_idFacturas')->references('idFacturas')->on('facturas')->onDelete('cascade');
            $table->foreign('Metodos_de_pago_idMetodos_de_pago')->references('idMetodos_de_pago')->on('metodos_de_pago')->onDelete('cascade');
            // Asumiendo que existe una tabla 'usuarios'
            $table->foreign('Usuarios_idUsuarios')->references('idUsuarios')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('pagos_facturas');
    }

};
