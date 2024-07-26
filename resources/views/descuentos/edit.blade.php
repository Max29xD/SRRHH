@extends('adminlte::page')

@section('title', 'Editar Descuento')

@section('content_header')
    <h1>Editar Descuento</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de Edición de Descuento</h3>
                    </div>
                    <form action="{{ route('descuentos.update', $descuento->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="monto">Monto del Descuento</label>
                                <input type="number" class="form-control" id="monto" name="monto" step="0.01" value="{{ old('monto', $descuento->monto) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoDescuento">Tipo de Descuento</label>
                                <select class="form-control" id="tipoDescuento" name="tipoDescuento" required>
                                    <option value="">Seleccionar Tipo</option>
                                    <option value="prestamo" {{ $descuento->tipoDescuento == 'prestamo' ? 'selected' : '' }}>Préstamo</option>
                                    <option value="responsabilidad" {{ $descuento->tipoDescuento == 'responsabilidad' ? 'selected' : '' }}>Responsabilidad</option>
                                    <option value="garantia_equipos" {{ $descuento->tipoDescuento == 'garantia_equipos' ? 'selected' : '' }}>Garantía de Equipos</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingrese una descripción...">{{ old('descripcion', $descuento->descripcion) }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Actualizar Descuento</button>
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
    <script> console.log('Editar Descuento Page'); </script>
@stop
