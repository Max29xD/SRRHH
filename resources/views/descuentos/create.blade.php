@extends('adminlte::page')

@section('title', 'Agregar Descuento')

@section('content_header')
    <h1>Agregar Descuento</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de Descuento</h3>
                    </div>
                    <form action="{{ route('nomina.aplicarDescuentos') }}" method="POST">
                        @csrf
                        <!-- Campo oculto para el ID del empleado -->
                        <input type="hidden" name="empleado_id" value="{{ request('empleado_id') }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="monto">Monto del Descuento</label>
                                <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoDescuento">Tipo de Descuento</label>
                                <select class="form-control" id="tipoDescuento" name="tipoDescuento" required>
                                    <option value="">Seleccionar Tipo</option>
                                    <option value="prestamo">Préstamo</option>
                                    <option value="responsabilidad">Responsabilidad</option>
                                    <option value="garantia_equipos">Garantía de Equipos</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese una descripción..."></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Aplicar Descuento</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script> console.log('Agregar Descuento Page'); </script>
@stop
