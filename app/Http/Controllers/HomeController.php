<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

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
        $empleados = Empleado::join('datos_laborales', 'empleados.id', '=', 'datos_laborales.empleado_id')
        ->orderByDesc('datos_laborales.salario')
        ->select('empleados.*', 'datos_laborales.salario', 'datos_laborales.puesto')
        ->take(5)
        ->get();

        return view('home', compact('empleados'));
    }
    
}
