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

        DB::table('users')->insert([
            [
                'cedula' => '12345678',
                'nombres' => 'Carlos Samuel',
                'apellidos' => 'Medina Pardo',
                'correo' => 'csamuelrox@gmail.com',
                'password' => bcrypt('12345678'),
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
