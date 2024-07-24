<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDescuentoRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nomina_id' => 'required|exists:nominas,id',
            'empleado_id' => 'required|exists:empleados,id',
            'tipoDescuento' => 'required|string',
            'monto' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ];
    }


    public function messages()
    {
        return [
            'nomina_id.required' => 'El campo Nómina es obligatorio.',
            'nomina_id.exists' => 'La nómina seleccionada no existe.',
            'empleado_id.required' => 'El campo Empleado es obligatorio.',
            'empleado_id.exists' => 'El empleado seleccionado no existe.',
            'tipoDescuento.required' => 'El campo Tipo de Descuento es obligatorio.',
            'tipoDescuento.string' => 'El campo Tipo de Descuento debe ser una cadena de texto.',
            'monto.required' => 'El campo Monto es obligatorio.',
            'monto.numeric' => 'El campo Monto debe ser un número.',
            'descripcion.string' => 'El campo Descripción debe ser una cadena de texto.',
        ];
    }

}
