@extends('adminlte::page')

@section('title', 'Registrar Asistencia')

@section('content_header')
    <h1>Registrar Asistencia</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Formulario de Asistencia</h3>
                    </div>
                    <form action="{{ route('asistencias.store') }}" method="POST"> 
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ci">Número de Carnet</label>
                                <input type="text" class="form-control" id="ci" name="ci" required>
                            </div>
                            <div class="form-group">
                                <label for="hora_llegada">Hora de Llegada</label>
                                <input type="time" class="form-control" id="hora_llegada" name="hora_llegada">
                            </div>
                            <div class="form-group">
                                <label for="hora_salida">Hora de Salida</label>
                                <input type="time" class="form-control" id="hora_salida" name="hora_salida">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
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
    <script> console.log('Registrar Asistencia Page'); </script>
@stop
