@extends('adminlte::page')

@section('title', 'Nómina')

@section('content_header')
    <div class="bg-light p-3">
        <h1 class="text-center"><strong>Nomina</strong></h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de empleados</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Sueldo</th>
                        <th>Días Trabajados</th>
                        <th>Bono Antigüedad</th>
                        <th>Total Ganado</th>
                        <th>AFP</th>
                        <th>Líquido Pagable</th>
                        <th>Boleta de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->ci }}</td>
                            <td>{{ $empleado->nombreCompleto }}</td>
                            <td>{{ $empleado->sueldo }} Bs</td>
                            <td>{{ $empleado->diasTrabajados ?? 0 }}</td>
                            <td>{{ number_format($empleado->bonoAntiguedad ?? 0, 2) }} Bs</td>
                            <td>{{ number_format($empleado->totalGanado ?? 0, 2) }} Bs</td>
                            <td>{{ number_format($empleado->afp ?? 0, 2) }} Bs</td>
                            <td>{{ number_format($empleado->liquidoPagable ?? 0, 2) }} Bs</td>
                            <td>
                                <form action="{{ route('nomina.generarBoleta', $empleado->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="number" name="descuento" class="form-control col-md-9" placeholder="Descuento" step="0.01" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Generar boleta</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
