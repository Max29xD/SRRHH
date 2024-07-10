@extends('adminlte::page')

@section('title', 'Lista de Empleados')

@section('content_header')
    <div class="bg-light p-3">
        <h1 class="text-center"><strong>Empleados</strong></h1>
    </div>
@stop

@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de empleados</h3>
            <div class="form-group col-md-12 text-right">
                <a href="{{ route('empleados.create') }}" class="btn btn-success btn-sm">Registrar Empleado</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>C.I.</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Puesto</th>
                        <th>Sueldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombreCompleto }}</td>
                            <td>{{ $empleado->ci }}</td>
                            <td>{{ $empleado->telefono }}</td>
                            <td>{{ $empleado->email }}</td>
                            <td>{{ $empleado->datosLaborales->puesto }}</td>
                            <td>{{ $empleado->datosLaborales->salario }} Bs</td>

                            <td>
                                <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-secondary btn-sm">Detalles</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@stop
