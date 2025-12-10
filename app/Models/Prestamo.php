<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    /** @use HasFactory<\Database\Factories\PrestamoFactory> */
    use HasFactory;
    protected $table = 'prestamos';

    protected $fillable = [
        'equipo_id',
        'nombre_solicitante',
        'correo',
        'estado',
        'fecha_prestamo',
        'comentario_final',
    ];


    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
