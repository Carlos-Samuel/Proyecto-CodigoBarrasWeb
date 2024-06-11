<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UsuarioPermiso extends Pivot
{
    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'usuarios_tienen_permisos';

    /**
     * Indica si el modelo debería usar timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'permiso_id',
    ];
}
