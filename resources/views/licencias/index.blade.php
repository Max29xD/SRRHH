@extends('adminlte::page')

@section('title', 'Ver Licencias')

@section('content_header')
    <div class="bg-light p-3">
        <h1 class="text-center"><strong>Lista de licencias</strong></h1>
    </div>
@stop

@section('content')
    @if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('licencias.index') }}" method="GET" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="empleado_id" class="mr-2">Empleado:</label>
                <select name="empleado_id" id="empleado_id" class="form-control">
                    <option value="">Todos</option>
                    @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}"{{ request('empleado_id') == $empleado->id ? ' selected' : '' }}>{{ $empleado->nombreCompleto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="tipo" class="mr-2">Tipo de Licencia:</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Todos</option>
                    <option value="enfermedad"{{ request('tipo') == 'enfermedad' ? ' selected' : '' }}>Enfermedad</option>
                    <option value="vacaciones"{{ request('tipo') == 'vacaciones' ? ' selected' : '' }}>Vacaciones</option>
                    <option value="personal"{{ request('tipo') == 'personal' ? ' selected' : '' }}>Personal</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="fecha_inicio" class="mr-2">Fecha de Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="fecha_fin" class="mr-2">Fecha de Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Licencias</h3>
            <div class="form-group col-md-12 text-right">
                <button type="submit" class="btn btn-success" onclick="location.href='licencias/create'">Nueva licencia</button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Tipo de Licencia</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($licencias as $licencia)
                        <tr>
                            <td>{{ $licencia->id }}</td>
                            <td>{{ $licencia->empleado->nombreCompleto }}</td>
                            <td>{{ $licencia->tipo }}</td>
                            <td>{{ $licencia->fecha_inicio }}</td>
                            <td>{{ $licencia->fecha_fin }}</td>
                            <td>{{ $licencia->descripcion }}</td>
                            <td>
                                <a href="{{ route('licencias.edit', $licencia) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('licencias.destroy', $licencia) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }
    });
</script>