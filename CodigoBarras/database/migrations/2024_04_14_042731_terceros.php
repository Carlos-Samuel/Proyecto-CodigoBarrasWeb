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
        Schema::create('terceros', function (Blueprint $table) {
            $table->id();
            $table->string('numero_identificacion', 20);
            $table->unsignedBigInteger('tipo_identificacion_id'); // Referencia a la tabla tipo_documento
            $table->integer('digito_verificacion')->nullable();
            $table->string('primer_apellido', 50)->nullable();
            $table->string('segundo_apellido', 50)->nullable();
            $table->string('primer_nombre', 50)->nullable();
            $table->string('segundo_nombre', 50)->nullable();
            $table->string('razon_social', 100)->nullable();
            $table->string('direccion', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('celular', 20);
            $table->string('email', 100);
            $table->string('sitio_web', 100)->nullable();
            $table->unsignedInteger('pais_id'); // Referencia a la tabla paises
            $table->string('ciudad', 20); // Referencia a la tabla divipola
            $table->unsignedBigInteger('regimen_id'); // Referencia a la tabla regimen
            $table->unsignedBigInteger('tipo_persona_id'); // Referencia a la tabla tipo_persona
            $table->unsignedBigInteger('tipo_tercero'); // 'cliente', 'proveedor', 'empleado'
            $table->boolean('activo')->default(true);

            $table->foreign('tipo_identificacion_id')->references('id')->on('tipo_documento');
            $table->foreign('pais_id')->references('codigo_iso_numeric')->on('paises');
            $table->foreign('ciudad')->references('codigo')->on('divipola');
            $table->foreign('regimen_id')->references('id')->on('regimen');
            $table->foreign('tipo_persona_id')->references('id')->on('tipo_persona');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terceros');
    }
};
