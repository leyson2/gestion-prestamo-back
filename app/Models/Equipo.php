<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    /** @use HasFactory<\Database\Factories\EquipoFactory> */
    use HasFactory;
    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
