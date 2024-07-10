<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpleadoRequest extends FormRequest
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
            'nombreCompleto' => 'required|string|max:50',
            'ci' => 'required|string|max:30|unique:empleados,ci' . $this->empleado,
            'telefono' => 'required|string|max:16|unique:empleados,telefono' . $this->empleado,
            'fechaNacimiento' => 'required|date',
            'email' => 'required|email|max:50|unique:empleados,email' . $this->empleado,
            'direccion' => 'required|string|max:200',  
            //-----------------------------------------------  
            'salario' => 'required|numeric',
            'puesto' => 'required|string|max:50',
            'fechaContratacion' => 'required|date',
            'fechaSalida' => 'nullable|date',
            'trabajosAnteriores' => 'nullable|string|max:250',
            //--------------------------------------------------
            'nombreRelacionEmpleado' => 'required|string|max:100',
            'numeroEmergenciaFamiliar' => 'required|string|max:15',
            'direccionEmergencia' => 'required|string|max:100',
        ];        
      }

      public function messages()
        {
            return [
                'ci.required' => 'El C.I. es obligatorio.',
                'ci.unique' => 'El C.I. ya ha sido registrado.',
                //-------------------------------------------
                'email.required' => 'El email es obligatorio.',
                'email.unique' => 'El email ya ha sido registrado.',
                //------------------------------------------- 
                'telefono.required' => 'El telefono es obligatorio.',
                'telefono.unique' => 'El telefono ya ha sido registrado.', 
            ];
        }
}
