@extends('adminlte::page')

@section('title', 'Nómina')

@section('content_header')
    <div class="bg-light p-3">
        <h1 class="text-center"><strong>Planilla de Sueldos</strong></h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Formulario de búsqueda -->
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title">Buscar Nómina</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('nomina.calcular') }}" method="GET">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="anio">Año</label>
                            <input type="number" class="form-control" id="anio" name="anio"
                                value="{{ request('anio') }}" placeholder="Ingrese el año" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mes">Mes</label>
                            <select class="form-control" id="mes" name="mes" required>
                                <option value="">Seleccione un mes</option>
                                <option value="01" {{ request('mes') == '01' ? 'selected' : '' }}>Enero</option>
                                <option value="02" {{ request('mes') == '02' ? 'selected' : '' }}>Febrero</option>
                                <option value="03" {{ request('mes') == '03' ? 'selected' : '' }}>Marzo</option>
                                <option value="04" {{ request('mes') == '04' ? 'selected' : '' }}>Abril</option>
                                <option value="05" {{ request('mes') == '05' ? 'selected' : '' }}>Mayo</option>
                                <option value="06" {{ request('mes') == '06' ? 'selected' : '' }}>Junio</option>
                                <option value="07" {{ request('mes') == '07' ? 'selected' : '' }}>Julio</option>
                                <option value="08" {{ request('mes') == '08' ? 'selected' : '' }}>Agosto</option>
                                <option value="09" {{ request('mes') == '09' ? 'selected' : '' }}>Septiembre</option>
                                <option value="10" {{ request('mes') == '10' ? 'selected' : '' }}>Octubre</option>
                                <option value="11" {{ request('mes') == '11' ? 'selected' : '' }}>Noviembre</option>
                                <option value="12" {{ request('mes') == '12' ? 'selected' : '' }}>Diciembre</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de empleados -->
        <form action="{{ route('nomina.guardarNomina') }}" method="POST">
            @csrf
            <div class="card">
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Lista de empleados</h3>
                    <div class="right">
                        <button type="button" class="btn btn-primary"
                            onclick="window.location.href='{{ route('nomina.calcular') }}'">Volver a Planilla</button>
                    </div>
                </div>
                <div class="card-body">
                    @if ($detalleNominas->isEmpty())
                        <p>No se encontraron empleados para el período seleccionado.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>CI</th>
                                    <th>Nombre</th>
                                    <th>Sueldo Base</th>
                                    <th>Días Trabajados</th>
                                    <th>Descuento Adicional</th>
                                    <th>Total Descuentos</th>
                                    <th>Líquido Pagable</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleNominas as $detalle)
                                    <tr>
                                        <td>{{ $detalle->empleado->ci }}</td>
                                        <td>{{ $detalle->empleado->nombreCompleto }}</td>
                                        <td>{{ number_format($detalle->empleado->datosLaborales->salario, 2) }} Bs</td>
                                        <td>{{ number_format($detalle->diasTrabajados ?? 0) }}</td>
                                        <td>{{ number_format($detalle->descuentoAdicional, 2) }} Bs</td>
                                        <td>{{ number_format($detalle->totalDescuento, 2) }} Bs</td>
                                        <td>{{ number_format($detalle->liquidoPagable, 2) }} Bs</td>
                                        <td class="text-center">
                                            <!-- Botón para Ver Boleta con color según estado -->
                                            <a href="{{ route('nomina.boleta', ['empleado_id' => $detalle->empleado_id]) }}"
                                                class="btn {{ $detalle->boletaPago && $detalle->boletaPago->estado ? 'btn-success' : 'btn-warning' }}">
                                                <i class="fas fa-file-alt"></i>
                                             </a>
                                            <!-- Botón para Descuentos -->
                                            <a href="{{ route('descuentos.create', ['empleado_id' => $detalle->empleado_id]) }}"
                                                class="btn btn-danger">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log('Nómina Page');
    </script>
@stop
