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

    public function store(StoreDescuentoRequest $request)
{
    // Los datos ya están validados por el FormRequest
    $validated = $request->validated();

    // Encuentra el empleado y la nómina
    $empleado = Empleado::find($validated['empleado_id']);
    $nomina = Nomina::where('id', $empleado->nomina_id)->first();

    // Verifica si la nómina existe
    if ($nomina) {
        // Crear el nuevo descuento
        Descuento::create([
            'empleado_id' => $validated['empleado_id'],
            'monto' => $validated['monto'],
            'tipoDescuento' => $validated['tipoDescuento'],
            'descripcion' => $validated['descripcion'],
        ]);

        // Actualizar el total de descuentos en la nómina
        $nomina->totalDescuentos += $validated['monto'];
        $nomina->save();
    }

    // Redirige a la vista deseada con un mensaje de éxito
    return redirect()->route('nomina.index')->with('success', 'Descuento aplicado exitosamente');
}
}
