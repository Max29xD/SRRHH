@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="card mx-3">
            <div class="card-header">
                <h3 class="text-center">Empleados mejores pagados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Sueldo</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombreCompleto }}</td>
                                <td>{{ $empleado->datosLaborales->salario }}</td>
                                <td>{{ $empleado->datosLaborales->puesto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mx-3">
            <div class="card-header">
                <h3 class="text-center">Empleados antiguos mejores pagados</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Sueldo</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            <tr>
                                <td>{{ $empleado->nombreCompleto }}</td>
                                <td>{{ $empleado->datosLaborales->salario }}</td>
                                <td>{{ $empleado->datosLaborales->puesto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
