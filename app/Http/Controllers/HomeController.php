<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\detalleNomina;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener los 3 empleados con los mayores sueldos
        $empleadosMejoresSueldos = Empleado::join('datos_laborales', 'empleados.id', '=', 'datos_laborales.empleado_id')
            ->orderByDesc('datos_laborales.salario')
            ->select('empleados.nombreCompleto', 'datos_laborales.salario')
            ->take(3)
            ->get();

        // Obtener los 3 empleados con los sueldos más bajos
        $empleadosSueldoBajo = Empleado::join('datos_laborales', 'empleados.id', '=', 'datos_laborales.empleado_id')
            ->orderBy('datos_laborales.salario')
            ->select('empleados.nombreCompleto', 'datos_laborales.salario')
            ->take(3)
            ->get();

        // Calcular el promedio de sueldos
        $promedioSueldos = Empleado::join('datos_laborales', 'empleados.id', '=', 'datos_laborales.empleado_id')
            ->avg('datos_laborales.salario');

        // Calcular el total pagado en sueldos
        $totalPagado = DetalleNomina::sum('liquidoPagable');

        // Preparar datos para los gráficos
        $dataMejoresSueldos = [
            'labels' => $empleadosMejoresSueldos->pluck('nombreCompleto'),
            'data' => $empleadosMejoresSueldos->pluck('salario'),
        ];

        $dataSueldoBajo = [
            'labels' => $empleadosSueldoBajo->pluck('nombreCompleto'),
            'data' => $empleadosSueldoBajo->pluck('salario'),
        ];

        // Pasar los datos a la vista
        return view('home', compact('empleadosMejoresSueldos', 'empleadosSueldoBajo', 'promedioSueldos', 'totalPagado', 'dataMejoresSueldos', 'dataSueldoBajo'));
    }
    
}
