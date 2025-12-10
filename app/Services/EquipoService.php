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
}