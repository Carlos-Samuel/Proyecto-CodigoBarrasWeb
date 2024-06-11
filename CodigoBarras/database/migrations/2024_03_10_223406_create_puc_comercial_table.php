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
        Schema::create('pucComercial', function (Blueprint $table) {
            $table->integer('plncod')->comment('Codigo del plan de cuentas');
            $table->string('plnom', 256)->nullable()->comment('Nombre del plan de la cuenta');
            $table->string('plntip', 256)->nullable()->comment('Tipo (naturaleza) de la cuenta');
            $table->integer('plnniv')->comment('Nivel de la cuenta');
            
            $table->unique('plncod');
            
            $table->charset = 'utf8mb4';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pucComercial');
    }
};
