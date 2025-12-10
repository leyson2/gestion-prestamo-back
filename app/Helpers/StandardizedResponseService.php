<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class StandardizedResponseService
{
    /**
     * Respuesta exitosa con formato estandarizado
     */
    public static function success($data = [], $message = 'La solicitud se ha realizado correctamente.', $statusCode = Response::HTTP_OK)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Respuesta de error con formato estandarizado
     */
    public static function error($message = 'Ha ocurrido un error.', $statusCode = Response::HTTP_BAD_REQUEST, $errors = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
            'error_code' => $statusCode
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Respuesta de recurso no encontrado
     */
    public static function notFound($message = 'Recurso no encontrado.')
    {
        return self::error($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Respuesta de validación fallida
     */
    public static function validationFailed($errors, $message = 'La validación ha fallado.')
    {
        return self::error($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    /**
     * Respuesta de no autorizado
     */
    public static function unauthorized($message = 'No autorizado.')
    {
        return self::error($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Respuesta de servidor interno
     */
    public static function serverError($message = 'Error interno del servidor.')
    {
        return self::error($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Respuesta de creado exitosamente
     */
    public static function created($data = [], $message = 'Recurso creado exitosamente.')
    {
        return self::success($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Respuesta de actualizado exitosamente
     */
    public static function updated($data = [], $message = 'Recurso actualizado exitosamente.')
    {
        return self::success($data, $message, Response::HTTP_OK);
    }

    /**
     * Respuesta de eliminado exitosamente
     */
    public static function deleted($message = 'Recurso eliminado exitosamente.')
    {
        return self::success([], $message, Response::HTTP_OK);
    }

    /**
     * Respuesta con datos vacíos pero exitosa
     */
    public static function noContent($message = 'No hay contenido disponible.')
    {
        return self::success([], $message, Response::HTTP_NO_CONTENT);
    }
}
