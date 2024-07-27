@extends('adminlte::page')

@section('title', 'Boleta de Pago')

@section('content_header')
    <h1 class="text-center">Boleta de Pago</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalles de la Boleta de Pago</h3>
            </div>
            <div class="card-body">
                <!-- Información del Empleado -->
                <div class="mb-4 text-center">
                    <h4>Datos del Empleado</h4>
                    <p><strong>Nombre:</strong> {{ $empleado->nombreCompleto }}</p>
                    <p><strong>C.I.:</strong> {{ $empleado->ci }}</p>
                    <p><strong>Cargo:</strong> {{ $empleado->datosLaborales->puesto }}</p>
                    <p><strong>Fecha de Contrato:</strong> {{ $empleado->datosLaborales->fechaContratacion }}</p>
                </div>

                <!-- Información Financiera -->
                <div class="mb-4">
                    <h4>Información Financiera</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sueldo Base</td>
                                <td>{{ number_format($empleado->datosLaborales->salario, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>Bono de Antigüedad</td>
                                <td>{{ number_format($detalleNomina->bonoAntiguedad, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>Total Ganado</td>
                                <td>{{ number_format($detalleNomina->totalGanado, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>AFP</td>
                                <td>{{ number_format($detalleNomina->afp, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>RC-IVA</td>
                                <td>{{ number_format($detalleNomina->rc_iva, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>Descuento Adicional</td>
                                <td>{{ number_format($detalleNomina->descuentoAdicional, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>Total Descuentos</td>
                                <td>{{ number_format($detalleNomina->totalDescuento, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td>Líquido Pagable</td>
                                <td>{{ number_format($detalleNomina->liquidoPagable, 2) }} Bs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Detalle de Descuentos -->
                <div class="mt-4">
                    <h4>Descuentos</h4>
                    @if($empleado->descuentos->isEmpty())
                        <p>No hay descuentos registrados para este empleado.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tipo de Descuento</th>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empleado->descuentos as $descuento)
                                    <tr>
                                        <td>{{ $descuento->tipoDescuento }}</td>
                                        <td>{{ $descuento->descripcion }}</td>
                                        <td>{{ number_format($descuento->monto, 2) }} Bs</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log('Boleta de Pago Page');
    </script>
@stop
