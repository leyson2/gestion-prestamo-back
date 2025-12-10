<?php

namespace App\Services;

use App\Helpers\StandardizedResponseService;
use App\Interfaces\PrestamoInterface;
use Carbon\Carbon;

class PrestamoService
{
    protected $prestamoRepository;

    public function __construct(PrestamoInterface $prestamoRepository)
    {
        $this->prestamoRepository = $prestamoRepository;
    }

    public function index()
    {
        $resp = $this->prestamoRepository->index();
        if (!$resp) {
            return StandardizedResponseService::notFound('No se encontraron prestamos');
        }
        try {
            return StandardizedResponseService::success($resp);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al obtener los prestamos', $e->getMessage());
        }
    }

    public function store(array $data)
    {
        if (!isset($data) || empty($data)) {
            return StandardizedResponseService::error('No se proporcionaron datos para crear el préstamo.');
        }

        try {
            return $this->prestamoRepository->store($data);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al crear el préstamo', $e->getMessage());
        }
    }

    public function show($id)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para buscar el préstamo.');
        }

        try {
            $resp = $this->prestamoRepository->show($id);
            if (!$resp) {
                return StandardizedResponseService::notFound('Préstamo no encontrado.');
            }
            return $resp;
        } catch (\Exception $e) {
            return StandardizedResponseService::error($e->getMessage());
        }
    }

    public function updateStatus($id, array $data)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para actualizar el estado del préstamo.');
        }

        $newData = [];
        if (($data['estado'] != 'DEVUELTO')) {
            $newData['comentario'] = null;
        }
        $data = array_merge($data, $newData);
        try {
            $resp = $this->prestamoRepository->updateStatus($id, $data);
            return $resp;
        } catch (\Exception $e) {
            return StandardizedResponseService::error($e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para actualizar el préstamo.');
        }

        $mappedData = [
            'equipo_id' => $data['equipoCode'],
            'nombre_solicitante' => $data['solicitante'],
            'correo' => $data['correo'],
            'estado' => $data['estado'],
            'fecha_prestamo' => Carbon::parse($data['fecha_prestamo'])->format('Y-m-d'),
            'comentario_final' => $data['estado'] != 'DEVUELTO' ? null : ($data['comentario']),
        ];
        try {
            $resp = $this->prestamoRepository->update($id, $mappedData);
            return $resp;
        } catch (\Exception $e) {
            return StandardizedResponseService::error($e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para eliminar el préstamo.');
        }

        $prestamo = $this->prestamoRepository->show($id);
        if (!$prestamo) {
            return StandardizedResponseService::notFound('Préstamo no encontrado.');
        }
        if ($prestamo->estado != 'SOLICITADO') {
            return StandardizedResponseService::error('Solo se pueden eliminar préstamos con estado "SOLICITADO"');
        }
        try {
            $resp = $this->prestamoRepository->destroy($id);
            return StandardizedResponseService::success('Préstamo eliminado exitosamente.');
        } catch (\Exception $e) {
            return StandardizedResponseService::error($e->getMessage());
        }
    }
}
