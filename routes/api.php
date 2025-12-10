<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('prestamos', PrestamoController::class);

Route::patch('prestamos/cambiar-estado/{id}', [PrestamoController::class, 'changeStatus']);

Route::apiResource('equipos', EquipoController::class);