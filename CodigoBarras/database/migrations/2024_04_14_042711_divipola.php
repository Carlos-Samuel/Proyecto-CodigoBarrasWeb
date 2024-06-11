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
        Schema::create('divipola', function (Blueprint $table) {
            $table->string('codigo', 20)->primary();; 
            $table->string('nombre', 100);
            $table->string('departamento_id', 20)->nullable(); 
            $table->foreign('departamento_id')->references('codigo')->on('divipola')->onDelete('cascade')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divipola'); // Elimina la tabla 'divipola' si existe
    }
};
