<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equipo_id' => 'required|exists:equipos,id',
            'nombre_solicitante' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'estado' => 'required|in:SOLICITADO,ENTREGADO,DEVUELTO',
            'fecha_prestamo' => 'required|date',
            'comentario_final' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'equipo_id.required' => 'El campo equipo es obligatorio.',
            'equipo_id.exists' => 'El equipo seleccionado no existe.',
            'nombre_solicitante.required' => 'El campo nombre del solicitante es obligatorio.',
            'nombre_solicitante.string' => 'El campo nombre del solicitante debe ser una cadena de texto.',
            'nombre_solicitante.max' => 'El campo nombre del solicitante no debe exceder los 255 caracteres.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El campo correo debe ser una dirección de correo válida.',
            'correo.max' => 'El campo correo no debe exceder los 255 caracteres.',
            'estado.required' => 'El campo estado es obligatorio.',
            'estado.in' => 'El campo estado debe ser uno de los siguientes valores: SOLICITADO, ENTREGADO, DEVUELTO.',
            'fecha_prestamo.required' => 'El campo fecha de préstamo es obligatorio.',
            'fecha_prestamo.date' => 'El campo fecha de préstamo debe ser una fecha válida.',
        ];
    }
}
