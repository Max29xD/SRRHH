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
                <form action="{{ route('nomina.filtro') }}" method="GET">
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
        <form action="{{ route('nomina.guardar') }}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Guardar Nómina</button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CI</th>
                                <th>Nombre</th>
                                <th>Sueldo base</th>
                                <th>Días Trabajados</th>
                               {{--  <th>Bono Antigüedad</th>
                                <th>Total Ganado</th>
                                <th>AFP</th>
                                <th>RC-IVA</th> --}}
                                <th>Descuento Adicional</th>
                                <th>Total Descuentos</th>
                                <th>Líquido Pagable</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $empleado)
                                <tr>
                                    <td>{{ $empleado->ci }}</td>
                                    <td>{{ $empleado->nombreCompleto }}</td>
                                    <td>{{ number_format($empleado->sueldo ?? 0, 2) }} Bs</td>
                                    <td>{{ $empleado->diasTrabajados ?? 0 }}</td>
                                    {{-- <td>{{ number_format($empleado->bonoAntiguedad ?? 0, 2) }} Bs</td>
                                    <td>{{ number_format($empleado->totalGanado ?? 0, 2) }} Bs</td>
                                    <td>{{ number_format($empleado->afp ?? 0, 2) }} Bs</td>
                                    <td>{{ number_format($empleado->rc_iva ?? 0, 2) }} Bs</td> --}}
                                    <td>{{ number_format($empleado->descuentoAdicional ?? 0, 2) }}</td>
                                    <td>{{ number_format($empleado->totalDescuento ?? 0, 2) }} Bs</td>
                                    <td>{{ number_format($empleado->liquidoPagable ?? 0, 2) }} Bs</td>
                                    <td class="text-center">
                                        <a href="{{ route('descuentos.create', ['empleado_id' => $empleado->id]) }}"
                                            class="btn btn-danger">
                                            <i class="fas fa-minus"></i>
                                        </a>
                                        {{-- <a href="{{ route('nomina.boleta', ['empleado_id' => $empleado->id]) }}" class="btn btn-primary">
                                            <i class="fas fa-file-alt"></i> 
                                        </a> --}}
                                    </td>
                                    <!-- Campos ocultos para cada empleado -->
                                    <input type="hidden" name="empleados[{{ $empleado->id }}][id]"
                                        value="{{ $empleado->id }}">

                                    {{-- <input type="hidden" name="empleados[{{ $empleado->id }}][sueldo]"
                                        value="{{ $empleado->sueldo }}">
 --}}
                                    <input type="hidden" name="empleados[{{ $empleado->id }}][diasTrabajados]"
                                        value="{{ $empleado->diasTrabajados }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][bonoAntiguedad]"
                                        value="{{ $empleado->bonoAntiguedad }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][totalGanado]"
                                        value="{{ $empleado->totalGanado }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][afp]"
                                        value="{{ $empleado->afp }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][rc_iva]"
                                        value="{{ $empleado->rc_iva }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][descuentoAdicional]"
                                        value="{{ $empleado->descuentoAdicional }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][totalDescuento]"
                                        value="{{ $empleado->totalDescuento }}">

                                    <input type="hidden" name="empleados[{{ $empleado->id }}][liquidoPagable]"
                                        value="{{ $empleado->liquidoPagable }}">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>


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

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log('Nómina Page');
    </script>
@stop
