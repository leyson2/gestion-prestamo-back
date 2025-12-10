<?php

namespace App\Services;

use App\Helpers\StandardizedResponseService;
use App\Interfaces\EquipoInterface;

class EquipoService
{
    protected $EquipoRepository;

    public function __construct(EquipoInterface $EquipoRepository)
    {
        $this->EquipoRepository = $EquipoRepository;
    }

    public function index()
    {

        $resp = $this->EquipoRepository->index();
        if (!$resp) {
            return StandardizedResponseService::notFound('No se encontraron equipos');
        }
        try {
            return StandardizedResponseService::success($resp);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al obtener los equipos', $e->getMessage());
        }
    }

    public function store(array $data)
    {
        if (!isset($data) || empty($data)) {
            return StandardizedResponseService::error('No se proporcionaron datos para crear el equipo.');
        }

        try {
            return $this->EquipoRepository->store($data);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al crear el equipo', $e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para actualizar el equipo.');
        }

        try {
            return $this->EquipoRepository->update($id, $data);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al actualizar el equipo', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (!isset($id) || empty($id)) {
            return StandardizedResponseService::error('No se proporcionó un código válido para eliminar el equipo.');
        }

        try {
            return $this->EquipoRepository->destroy($id);
        } catch (\Exception $e) {
            return StandardizedResponseService::error('Error al eliminar el equipo', $e->getMessage());
        }
    }
}