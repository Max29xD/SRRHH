<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\detalleNomina;
use App\Models\boletaPago;

class BoletaPagoController extends Controller
{
    public function index()
    {
        // Obtener todas las boletas de pago con sus detalles relacionados
        $boletasPagos = BoletaPago::with(['detalleNomina.empleado.datosLaborales'])->get();

        // Pasar los datos a la vista
        return view('boleta.index', ['boletasPagos' => $boletasPagos]);
    }

    public function show($empleado_id)
    {
        // Obtener el empleado y los detalles de la nómina
        $empleado = Empleado::with('datosLaborales', 'descuentos')->findOrFail($empleado_id);
        $detalleNomina = DetalleNomina::where('empleado_id', $empleado_id)->firstOrFail();

        // Verificar si ya existe una boleta de pago para este empleado y nómina
        $boletaPago = BoletaPago::where('empleado_id', $empleado_id)
            ->where('nomina_id', $detalleNomina->nomina_id)
            ->first();


        // Pasar la boleta de pago a la vista
        return view('boleta.show', compact('empleado', 'detalleNomina', 'boletaPago'));
    }

    public function store(Request $request)
    {
        // Obtener los datos del filtro de la sesión
        $datosDelFiltro = session()->get('datosDelFiltro', []);

        $empleado_id = $request->input('empleado_id');
        $nomina_id = $request->input('nomina_id');

        $detalleNomina = DetalleNomina::where('empleado_id', $empleado_id)
            ->where('nomina_id', $nomina_id)
            ->firstOrFail();

        // Crear o actualizar la boleta de pago
        BoletaPago::updateOrCreate(
            ['empleado_id' => $empleado_id, 'nomina_id' => $nomina_id],
            [
                'diasTrabajados' => $detalleNomina->diasTrabajados,
                'salario' => $detalleNomina->empleado->datosLaborales->salario,
                'bonoAntiguedad' => $detalleNomina->bonoAntiguedad,
                'totalGanado' => $detalleNomina->totalGanado,
                'afp' => $detalleNomina->afp,
                'rc_iva' => $detalleNomina->rc_iva,
                'descuentoAdicional' => $detalleNomina->descuentoAdicional,
                'totalDescuento' => $detalleNomina->totalDescuento,
                'liquidoPagable' => $detalleNomina->liquidoPagable,
                'fechaEmision' => now(),
                'estado' => true,
            ]
        );

        // Redirigir a la ruta 'nomina.filtro' con los datos del filtro en la consulta
        return redirect()->route('nomina.filtro', array_merge($datosDelFiltro, ['empleado_id' => $empleado_id]))
            ->with('success', 'Boleta de pago guardada exitosamente');
    }
}
