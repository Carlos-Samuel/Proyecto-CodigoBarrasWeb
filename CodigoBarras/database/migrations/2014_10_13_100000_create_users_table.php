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
        Schema::create('users', function (Blueprint $table) {
            $table->id('idUsuarios');
            $table->string('cedula', 45)->nullable()->unique();
            $table->string('nombres', 45)->nullable();
            $table->string('apellidos', 45)->nullable();
            $table->string('correo', 45)->nullable();
            $table->string('password', 128)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
            $table->comment('Tabla para el manejo de usuarios y correos');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
