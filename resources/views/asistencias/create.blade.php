@extends('adminlte::page')

@section('title', 'Registrar Asistencia')

@section('content_header')
    <h1 class="text-center">Registrar Asistencia</h1>
@stop

@section('content')
    @if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
    @endif

    <style>
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }
        .card {
            width: 100%;
            margin: 10px 0; 
        }
        .form-group {
            margin-bottom: 20px; 
        }
        .form-control {
            height: calc(1.5em + 1rem + 2px); 
            padding: .5rem 1rem; 
            font-size: 1.25rem;
        }
        .btn {
            padding: .75rem 1.5rem; 
            font-size: 1.25rem; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3; 
            color: white;
        }
        .btn-success:hover {
            background-color: #218838; 
            color: white; 
        }
    </style>

    <div class="container center-container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Llegada</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asistencias.registrarLlegada') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="ci">Número de Carnet:</label>
                                <input type="text" name="ci" id="ci" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Llegada</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registrar Salida</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asistencias.registrarSalida') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="ci">Número de Carnet:</label>
                                <input type="text" name="ci" id="ci" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Registrar Salida</button>
                        </form>     
                    </div>
                </div>
            </div>
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