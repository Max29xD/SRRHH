@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Página Principal</h1>
@stop

@section('content')
    <div class="row">
        <!-- Gráfico de los 3 Mejores Sueldos -->
        <div class="card mx-3">
            <div class="card-header">
                <h3 class="text-center">Empleados con Mejores Sueldos</h3>
            </div>
            <div class="card-body">
                <canvas id="chartMejoresSueldos"></canvas>
            </div>
        </div>

        <!-- Gráfico de los 3 Sueldos Más Bajos -->
        <div class="card mx-3">
            <div class="card-header">
                <h3 class="text-center">Empleados con Sueldos Más Bajos</h3>
            </div>
            <div class="card-body">
                <canvas id="chartSueldoBajo"></canvas>
            </div>
        </div>

        <!-- Gráfico de Promedio de Sueldos -->
        <div class="card mx-3">
            <div class="card-header">
                <h3 class="text-center">Promedio de Sueldos</h3>
            </div>
            <div class="card-body">
                <canvas id="chartPromedioSueldos"></canvas>
            </div>
        </div>

        <!-- Total Pagado en Sueldos -->
        <div class="card mx-6">
            <div class="card-header">
                <h3 class="text-center">Total Pagado en Sueldos</h3>
            </div>
            <div class="card-body">
                <p class="text-center">Total Pagado: {{ number_format($totalPagado, 2) }} Bs</p>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gráfico de los 3 Mejores Sueldos
            var ctxMejoresSueldos = document.getElementById('chartMejoresSueldos').getContext('2d');
            new Chart(ctxMejoresSueldos, {
                type: 'bar',
                data: {
                    labels: @json($dataMejoresSueldos['labels']),
                    datasets: [{
                        label: 'Sueldo',
                        data: @json($dataMejoresSueldos['data']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico de los 3 Sueldos Más Bajos
            var ctxSueldoBajo = document.getElementById('chartSueldoBajo').getContext('2d');
            new Chart(ctxSueldoBajo, {
                type: 'bar',
                data: {
                    labels: @json($dataSueldoBajo['labels']),
                    datasets: [{
                        label: 'Sueldo',
                        data: @json($dataSueldoBajo['data']),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfico de Promedio de Sueldos (se puede mostrar como un único valor o en comparación)
            var ctxPromedioSueldos = document.getElementById('chartPromedioSueldos').getContext('2d');
            new Chart(ctxPromedioSueldos, {
                type: 'doughnut',
                data: {
                    labels: ['Promedio de Sueldos'],
                    datasets: [{
                        label: 'Promedio de Sueldos',
                        data: [{{ $promedioSueldos }}],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });
        });
    </script>
@stop
