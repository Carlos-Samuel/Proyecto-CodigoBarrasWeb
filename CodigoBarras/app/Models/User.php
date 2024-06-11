<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'idUsuarios';
    public $timestamps = true;

    protected $fillable = [
        'cedula',
        'nombres',
        'apellidos',
        'correo',
        'password',
        'activo'
    ];

    protected $hidden = [
        'password'
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
