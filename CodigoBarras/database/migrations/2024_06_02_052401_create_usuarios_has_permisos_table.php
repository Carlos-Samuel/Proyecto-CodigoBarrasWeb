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
        Schema::create('usuarios_has_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('Usuarios_idUsuarios');
            $table->unsignedBigInteger('Permisos_idPermisos');
            $table->primary(['Usuarios_idUsuarios', 'Permisos_idPermisos']);

            // Foreign keys
            $table->foreign('Usuarios_idUsuarios')->references('idUsuarios')->on('users')->onDelete('cascade');
            $table->foreign('Permisos_idPermisos')->references('idPermisos')->on('permisos')->onDelete('cascade');

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
        Schema::dropIfExists('usuarios_has_permisos');
    }
};
