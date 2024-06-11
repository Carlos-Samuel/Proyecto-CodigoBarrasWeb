<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenTicket extends Model
{
    use HasFactory;

    protected $table = 'imagenesTickets'; 
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_original',
        'nombre_guardado',
        'tipo_imagen',
        'tick_id',
        'usuario_id',
    ];

    /**
     * Obtiene el usuario asociado a la imagen.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Obtiene el ticket asociado a la imagen.
     */
    //public function ticket()
    //{
        //return $this->belongsTo(Ticket::class, 'tick_id');
    //}
}
