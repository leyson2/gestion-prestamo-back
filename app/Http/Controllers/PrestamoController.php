<?php

namespace App\Http\Controllers;

use App\Helpers\StandardizedResponseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrestamoRequest;
use App\Services\PrestamoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrestamoController extends Controller
{
    protected $prestamoService;

    public function __construct(PrestamoService $prestamoService)
    {
        $this->prestamoService = $prestamoService;
    }

    public function index()
    {
        return $this->prestamoService->index();
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'equipoCode' => 'required|exists:equipos,id',
            'solicitante' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'estado' => 'required|in:SOLICITADO,ENTREGADO,DEVUELTO',
            'fecha_prestamo' => 'required|date',
            'comentario' => 'nullable',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }

        try {
            $this->prestamoService->store($request->all());
            return StandardizedResponseService::success('Préstamo creado exitosamente.');
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }

    public function show($id)
    {
        $validate = Validator::make(['id' => $id], [
            'id' => 'required|exists:prestamos,id',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }
        try {
            $prestamo = $this->prestamoService->show($id);
            return StandardizedResponseService::success($prestamo);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }

    public function changeStatus(Request $request, $id)
    {

        $validate = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => 'required|exists:prestamos,id',
            'estado' => 'required|in:SOLICITADO,ENTREGADO,DEVUELTO',
            'comentario' => 'nullable',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }

        try {
            $this->prestamoService->updateStatus($id, $request->all());
            return StandardizedResponseService::success('Estado del préstamo actualizado exitosamente.');
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => 'required|exists:prestamos,id',
            'equipoCode' => 'required|exists:equipos,id',
            'solicitante' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'estado' => 'required|in:SOLICITADO,ENTREGADO,DEVUELTO',
            'fecha_prestamo' => 'required|date',
            'comentario' => 'nullable',
        ]);

        if ($validate->fails()) {
            return StandardizedResponseService::validationFailed('Error de validación', $validate->errors());
        }

        try {
            $this->prestamoService->update($id, $request->all());
            return StandardizedResponseService::success('Préstamo actualizado exitosamente.');
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
            return $this->prestamoService->destroy($id);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al procesar la solicitud', $e->getMessage());
        }
    }
}
