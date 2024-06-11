<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = ['cate_nombre', 'activo'];

    /**
     * Los atributos que deben ser ocultados para las matrices.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Los atributos que deben ser convertidos a los tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'activo' => 'boolean',
    ];
}
