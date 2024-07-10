@extends('adminlte::page')

@section('title', 'Registrar Empleado')

@section('content_header')
    <h1 class="text-center text- font-weight-bold">REGISTRO DE EMPLEADO</h1>
@stop

@section('content')
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registro Exitoso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="card-header">
                <h3 class="card-title"><strong>INGRESA LOS DATOS DEL EMPLEADO</strong></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('empleados.store') }}" method="POST">
                    @csrf
                    <!-- Sección de datos del empleado -->
                    <div class="form-complete">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombreCompleto">Nombre Completo:</label>
                                    <input type="text" name="nombreCompleto" id="nombreCompleto" class="form-control 
                                    
                                    @error('nombreCompleto')
                                         is-invalid 
                                    @enderror" value="{{ old('nombreCompleto') }}">

                                    @error('nombreCompleto')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="ci">Cedula de identidad:</label>
                                    <input type="text" name="ci" id="ci" class="form-control 
                                    
                                    @error('ci') 
                                        is-invalid 
                                    @enderror" value="{{ old('ci') }}">

                                    @error('ci')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>   
                                                
                                <div class="form-group">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control 

                                    @error('telefono') 
                                        is-invalid 
                                    @enderror" value="{{ old('telefono') }}">

                                    @error('telefono')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                
                            </div>
                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechaNacimiento">Fecha de nacimiento:</label>
                                    <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control 
                                    
                                    @error('fechaNacimiento') 
                                        is-invalid 
                                    @enderror" value="{{ old('fechaNacimiento') }}">

                                    @error('fechaNacimiento')
                                        <span class="invalid-feedback">{{ $message }}</span>{{-- muestra las reglas que anote en la validacion --}}
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" >Correo Electrónico:</label>
                                    <input type="email" name="email" id="email" class="form-control
                                    
                                    @error('email') 
                                        is-invalid 
                                    @enderror" value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Dirección:</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control 
                                    
                                    @error('direccion') 
                                        is-invalid 
                                    @enderror" value="{{ old('direccion') }}">
                                    
                                    @error('direccion')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                     
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección 2 de datos laborales -->
                    <div class="card-header">
                        <h3 class="card-title"><strong>DATOS LABORALES</strong></h3>
                    </div>
                    <div class="form-complete">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="puesto">Puesto:</label>
                                    <input type="text" name="puesto" id="puesto" class="form-control 
                                    
                                    @error('puesto') 
                                        is-invalid 
                                    @enderror" value="{{ old('puesto') }}">
                                    
                                    @error('puesto')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                                
                                <div class="form-group">
                                    <label for="fechaContratacion">Fecha de Contratación:</label>
                                    <input type="date" name="fechaContratacion" id="fechaContratacion" class="form-control 
                                    
                                    @error('fechaContratacion') 
                                        is-invalid 
                                    @enderror" value="{{ old('fechaContratacion') }}">
                                    
                                    @error('fechaContratacion')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <div class="form-group">
                                    <label for="salario">Salario:</label>
                                    <input type="number" step="0.01" name="salario" id="salario" class="form-control 
                                    
                                    @error('salario') 
                                        is-invalid 
                                    @enderror" value="{{ old('salario') }}">
                                    
                                    @error('salario')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fechaSalida">Fecha de Salida:</label>
                                    <input type="date" name="fechaSalida" id="fechaSalida" class="form-control 
                                    @error('fechaSalida') 
                                        is-invalid 
                                    @enderror" value="{{ old('fechaSalida') }}">
                                    
                                    @error('fechaSalida')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="trabajosAnteriores">Trabajos Anteriores:</label>
                                    <textarea name="trabajosAnteriores" id="trabajosAnteriores" class="form-control 
                                    @error('trabajosAnteriores') 
                                        is-invalid 
                                    @enderror" maxlength="250" style="width: 100%; height: 150px;">{{ old('trabajosAnteriores') }}</textarea>
                                
                                    @error('trabajosAnteriores')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    {{--------------------Datos de emergencia----------------}}
                   <div class="card-header">
                        <h3 class="card-title"><strong>DATOS DE EMERGENCIA</strong></h3>
                    </div>
                    <div class="form-complete">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombreRelacionEmpleado">Nombre y relación familiar:</label>
                                    <input type="text" name="nombreRelacionEmpleado" id="nombreRelacionEmpleado" class="form-control 
                                    @error('nombreRelacionEmpleado') 
                                        is-invalid 
                                    @enderror" value="{{ old('nombreRelacionEmpleado') }}">
                                    
                                    @error('nombreRelacionEmpleado')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                                                
                                <div class="form-group">
                                    <label for="numeroEmergenciaFamiliar">Número de familiar:</label>
                                    <input type="text" name="numeroEmergenciaFamiliar" id="numeroEmergenciaFamiliar" class="form-control 
                                    @error('numeroEmergenciaFamiliar') 
                                        is-invalid 
                                    @enderror" value="{{ old('numeroEmergenciaFamiliar') }}">
                                    
                                    @error('numeroEmergenciaFamiliar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="direccionEmergencia">Dirección familiar:</label>
                                    <input type="text" name="direccionEmergencia" id="direccionEmergencia" class="form-control 
                                    @error('direccionEmergencia') 
                                        is-invalid 
                                    @enderror" value="{{ old('direccionEmergencia') }}">
                                    
                                    @error('direccionEmergencia')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>           
                    <button type="submit" class="btn btn-primary mt-4">Registrar</button>
                </form>
            </div>
        </div> 
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            @if(session('success'))
                $('#successModal').modal('show');
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 3000); // La modal se ocultará después de 3 segundos
            @endif

            $('#empleadosTable').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#empleadosTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@stop
