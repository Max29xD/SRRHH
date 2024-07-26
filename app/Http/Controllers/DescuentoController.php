<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDescuentoRequest;
use Illuminate\Http\Request;
use App\Models\Nomina;
use App\Models\Descuento;
use App\Models\Empleado;

class DescuentoController extends Controller
{
    public function create(Request $request)
    {
        // Obtén las nóminas disponibles para la selección
        $nominas = Nomina::all();
        return view('descuentos.create', compact('nominas'));
    }

    public function edit($id)
    {
        // Encuentra el descuento por ID
        $descuento = Descuento::findOrFail($id);

        // Retorna la vista con el descuento encontrado
        return view('descuentos.edit', compact('descuento'));
    }

    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'monto' => 'required|numeric|min:0',
            'tipoDescuento' => 'required|string',
            'descripcion' => 'nullable|string',
        ]);

        // Encuentra el descuento por ID
        $descuento = Descuento::findOrFail($id);

        // Actualiza el descuento con los datos validados
        $descuento->update([
            'monto' => $validated['monto'],
            'tipoDescuento' => $validated['tipoDescuento'],
            'descripcion' => $validated['descripcion'],
        ]);

        // Redirige a una ruta adecuada con un mensaje de éxito
        return redirect()->route('nomina.calcular')->with('success', 'Descuento actualizado correctamente.');
    }
    
}
