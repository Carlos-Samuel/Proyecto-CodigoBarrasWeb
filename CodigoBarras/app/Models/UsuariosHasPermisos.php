<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosHasPermisos extends Model
{
    use HasFactory;

    protected $table = 'usuarios_has_permisos';
    public $timestamps = true;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'Usuarios_idUsuarios',
        'Permisos_idPermisos'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'Usuarios_idUsuarios');
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'Permisos_idPermisos');
    }
}
