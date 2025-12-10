<?php

namespace App\Repositories;

use App\Interfaces\EquipoInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EquipoRepository implements EquipoInterface
{

    public function index()
    {
        return DB::table('equipos')
            ->select(
                'id as code',
                'nombre',
            )
            ->orderBy('nombre', 'asc')
            ->get();
    }

    public function store(array $data)
    {
        return DB::table('equipos')->insert([
            'nombre' => $data['nombre'],
            'created_at' => Carbon::now(),
        ]);
    }

    public function update($id, array $data)
    {
        return DB::table('equipos')
            ->where('id', $id)
            ->update([
                'nombre' => $data['nombre'],
                'updated_at' => Carbon::now(),
            ]);
    }

    public function destroy($id)
    {
        return DB::table('equipos')
            ->where('id', $id)
            ->delete();
    }
}
