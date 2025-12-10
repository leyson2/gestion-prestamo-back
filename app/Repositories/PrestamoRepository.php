<?php

namespace App\Repositories;

use App\Interfaces\PrestamoInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrestamoRepository implements PrestamoInterface
{

    public function index()
    {
        return DB::table('prestamos as p')
            ->select(
                'p.id as code',
                'p.correo as correo',
                'eq.nombre as equipo',
                'eq.id as equipoCode',
                'nombre_solicitante as solicitante',
                'p.estado as estado',
                'p.fecha_prestamo',
                'p.comentario_final as comentario'
            )
            ->join('equipos as eq', 'p.equipo_id', '=', 'eq.id')
            ->get();
    }

    public function store(array $data)
    {
        return DB::table('prestamos')->insert([
            'equipo_id' => $data['equipoCode'],
            'nombre_solicitante' => $data['solicitante'],
            'correo' => $data['correo'],
            'estado' => $data['estado'],
            'fecha_prestamo' => Carbon::parse($data['fecha_prestamo'])->format('Y-m-d'),
            'comentario_final' => $data['comentario'] ?? null,
        ]);
    }

    public function show($id)
    {
        return DB::table('prestamos as p')
            ->select(
                'p.id as code',
                'p.correo as correo',
                'eq.nombre as equipo',
                'eq.id as equipoCode',
                'nombre_solicitante as solicitante',
                'p.estado as estado',
                'p.fecha_prestamo',
                'p.comentario_final as comentario'
            )
            ->join('equipos as eq', 'p.equipo_id', '=', 'eq.id')
            ->where('p.id', $id)
            ->first();
    }

    public function updateStatus($id, array $data)
    {
        return DB::table('prestamos')
            ->where('id', $id)
            ->update([
                'estado' => $data['estado'],
                'comentario_final' => $data['comentario'] ?? null,
            ]);
    }

    public function update($id, array $data)
    {
        return DB::table('prestamos')
            ->where('id', $id)
            ->update($data);
    }

    public function destroy($id)
    {
        return DB::table('prestamos')
            ->where('id', $id)
            ->delete();
    }

}
