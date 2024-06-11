<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'idPermisos';
    public $timestamps = true;

    protected $fillable = [
        'Descripcion'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuarios_has_permisos', 'Permisos_idPermisos', 'Usuarios_idUsuarios');
    }
}
