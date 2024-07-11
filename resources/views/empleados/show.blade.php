{{-- resources/views/empleados/show.blade.php --}}

@extends('adminlte::page')

@section('title', 'Detalles del Empleado')

@section('content_header')
    <h1 class="text-center">Detalles del Empleado</h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <!-- Columna de Datos Personales -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos Personales</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $empleado->id }}</td>
                        </tr>
                        <tr>
                            <th>Nombre Completo</th>
                            <td>{{ $empleado->nombreCompleto }}</td>
                        </tr>
                        <tr>
                            <th>C.I.</th>
                            <td>{{ $empleado->ci }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono</th>
                            <td>{{ $empleado->telefono }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $empleado->email }}</td>
                        </tr>
                        <tr>
                            <th>Carnet de Identidad</th>
                            <td>{{ $empleado->ci }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Nacimiento</th>
                            <td>{{ $empleado->fechaNacimiento }}</td>
                        </tr>
                        <tr>
                            <th>Dirección</th>
                            <td>{{ $empleado->direccion }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Columna de Datos Laborales y Contactos de Emergencia -->
        <div class="col-md-5">
            <!-- Card de Datos Laborales -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Datos Laborales</h3>
                </div>
                <div class="card-body">
                    @if ($empleado->datosLaborales)
                        <table class="table table-bordered">
                            <tr>
                                <th>Puesto</th>
                                <td>{{ $empleado->datosLaborales->puesto }}</td>
                            </tr>
                            <tr>
                                <th>Salario</th>
                                <td>{{ $empleado->datosLaborales->salario }} Bs</td>
                            </tr>
                            <tr>
                                <th>Fecha de Contratación</th>
                                <td>{{ $empleado->datosLaborales->fechaContratacion }}</td>
                            </tr>
                        </table>
                    @else
                        <p>No hay datos laborales disponibles.</p>
                    @endif
                </div>
            </div>

            <!-- Card de Contactos de Emergencia -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contactos de Emergencia</h3>
                </div>
                <div class="card-body">
                    @if ($empleado->contactosEmergencia)
                        <table class="table table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <td>{{ $empleado->contactosEmergencia->nombreRelacionEmpleado }}</td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td>{{ $empleado->contactosEmergencia->numeroEmergenciaFamiliar }}</td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td>{{ $empleado->contactosEmergencia->direccionEmergencia }}</td>
                            </tr>
                        </table>
                    @else
                        <p>No hay contactos de emergencia disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
