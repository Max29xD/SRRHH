@extends('adminlte::page')

@section('title', 'Boletas de Pago')

@section('content_header')
    <div class="bg-light p-3">
        <h1 class="text-center"><strong>Boletas de Pago</strong></h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado de Boletas de Pago</h3>
            </div>
            <div class="card-body">
                @if ($boletasPagos->isEmpty())
                    <p>No se encontraron boletas de pago.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CI</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($boletasPagos as $boleta)
                                <tr>
                                    <td>{{ $boleta->detalleNomina->empleado->datosLaborales->ci }}</td>
                                    <td>{{ $boleta->detalleNomina->empleado->nombreCompleto }}</td>
                                    <td>{{ $boleta->fecha }}</td>
                                    <td>
                                        @if ($boleta->estado)
                                            <span class="badge bg-success">Pagada</span>
                                        @else
                                            <span class="badge bg-warning">No Pagada</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@stop
