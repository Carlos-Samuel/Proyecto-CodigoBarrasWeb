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

        $user = DB::table('users')->where('cedula', '12345678')->first();

        if ($user) {
            $userId = $user->idUsuarios;

            $permissions = DB::table('permisos')->pluck('idPermisos');

            $userPermissions = [];
            foreach ($permissions as $permissionId) {
                $userPermissions[] = [
                    'Usuarios_idUsuarios' => $userId,
                    'Permisos_idPermisos' => $permissionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            DB::table('usuarios_has_permisos')->insert($userPermissions);
        }

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
