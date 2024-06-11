<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuarios';
    public $timestamps = true;

    protected $fillable = [
        'Cedula',
        'Nombres',
        'Apellidos',
        'Correo',
        'Password'
    ];

    protected $hidden = [
        'Password'
    ];

    public function pagos()
    {
        return $this->hasMany(PagoFactura::class, 'Usuarios_idUsuarios');
    }

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'usuarios_has_permisos', 'Usuarios_idUsuarios', 'Permisos_idPermisos');
    }
}
