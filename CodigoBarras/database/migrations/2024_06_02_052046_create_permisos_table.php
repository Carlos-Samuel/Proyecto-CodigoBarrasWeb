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
        Schema::create('permisos', function (Blueprint $table) {
            $table->id('idPermisos');
            $table->string('Descripcion', 45)->nullable();
            $table->timestamps();
        });

        // Insert initial data
        DB::table('permisos')->insert([
            ['Descripcion' => 'Registrar facturas y pagos'],
            ['Descripcion' => 'Informe 1'],
            ['Descripcion' => 'Informe 2'],
            ['Descripcion' => 'Informe 3'],
            ['Descripcion' => 'Formas de pago'],
            ['Descripcion' => 'Manejo de usuarios y permisos']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos');
    }
};
