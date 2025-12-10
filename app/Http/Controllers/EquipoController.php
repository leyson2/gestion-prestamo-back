<?php

namespace App\Http\Controllers;

use App\Helpers\StandardizedResponseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\EquipoService;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
     protected $equipoService;

    public function __construct(EquipoService $equipoService)
    {
        $this->equipoService = $equipoService;
    }

    public function index()
    {
        return $this->equipoService->index();
    }

     public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }

        try {
            $this->equipoService->store($request->all());
            return StandardizedResponseService::success('Equipo creado exitosamente.');
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $validate = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => 'required|exists:equipos,id',
            'nombre' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }

        try {
            $this->equipoService->update($id, $request->all());
            return StandardizedResponseService::success('Equipo actualizado exitosamente.');
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $validate = Validator::make(['id' => $id], [
            'id' => 'required|exists:prestamos,id',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }
        try {
            return $this->equipoService->destroy($id);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }

}
