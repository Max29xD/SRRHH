@extends('adminlte::page')

@section('title', 'Boleta de Pago')

@section('content_header')
    <h1 class="text-center">Boleta de Pago</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">Detalles de la Boleta de Pago</h3>
            </div>
            <div class="card-body">
                <!-- Información del Empleado -->
                <div class="mb-4 text-center">
                    <h4>Empleado</h4>
                    <p><strong>Nombre:</strong> {{ $empleado->nombreCompleto }}</p>
                    <p><strong>C.I.:</strong> {{ $empleado->ci }}</p>
                    <p><strong>Cargo:</strong> {{ $empleado->datosLaborales->puesto }}</p>
                </div>

                <!-- Información Financiera -->
                <div class="mb-4">
                    <h4>Información Financiera</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>Sueldo Base:</strong></td>
                                <td class="text-right">{{ number_format($empleado->datosLaborales->salario, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>Bono de Antigüedad:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->bonoAntiguedad, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>Total Ganado:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->totalGanado, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>AFP:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->afp, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>RC-IVA:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->rc_iva, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>Descuento Adicional:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->descuentoAdicional, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>Total Descuentos:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->totalDescuento, 2) }} Bs</td>
                            </tr>
                            <tr>
                                <td><strong>Líquido Pagable:</strong></td>
                                <td class="text-right">{{ number_format($detalleNomina->liquidoPagable, 2) }} Bs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Detalle de Descuentos -->
                <div class="mt-4">
                    <h4 class="text-center">Descuentos</h4>
                    @if($empleado->descuentos->isEmpty())
                        <p class="text-center">No hay descuentos registrados para este empleado.</p>
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
                                        <td class="text-right">{{ number_format($descuento->monto, 2) }} Bs</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Botón para Guardar la Boleta de Pago -->
                <div class="mt-4 text-center">
                    @if (!$boletaPago || !$boletaPago->estado)
                        <form action="{{ route('nomina.guardarBoleta') }}" method="POST">
                            @csrf
                            <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
                            <input type="hidden" name="nomina_id" value="{{ $detalleNomina->nomina_id }}">
                            <button type="submit" class="btn btn-primary">Guardar Boleta de Pago</button>
                        </form>
                    @else
                        <p class="text-success">La boleta de pago ya ha sido guardada.</p>
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
