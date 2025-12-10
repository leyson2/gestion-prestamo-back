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
}
