<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DescuentoController;
use App\Models\boletaPago;
use App\Http\Controllers\BoletaPagoController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('empleados')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('empleados.index'); // Listar empleados
    Route::get('/create', [EmpleadoController::class, 'create'])->name('empleados.create'); // Formulario de creación
    Route::post('/', [EmpleadoController::class, 'store'])->name('empleados.store'); // Guardar nuevo empleado
    Route::get('/{empleado}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit'); // Formulario de edición
    Route::put('/{empleado}', [EmpleadoController::class, 'update'])->name('empleados.update'); // Actualizar empleado
    Route::delete('/{empleado}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy'); // Eliminar empleado
    Route::get('empleados/{id}', [EmpleadoController::class, 'show'])->name('empleados.show');
    
    Route::get('/getByCI', [EmpleadoController::class, 'getByCI'])->name('empleados.getByCI');

});

Route::prefix('asistencias')->group(function () {
    Route::get('/create', [AsistenciaController::class, 'create'])->name('asistencias.create'); // Formulario para registrar asistencia
    Route::post('/llegada', [AsistenciaController::class, 'registrarLlegada'])->name('asistencias.registrarLlegada'); // Registrar llegada
    Route::post('/salida', [AsistenciaController::class, 'registrarSalida'])->name('asistencias.registrarSalida'); // Registrar salida
    Route::get('/', [AsistenciaController::class, 'index'])->name('asistencias.index'); // Ver asistencia
    
    Route::get('/createManual', [AsistenciaController::class, 'createManual'])->name('asistencias.createManual');
    Route::post('/store', [AsistenciaController::class, 'store'])->name('asistencias.store');

});

Route::prefix('licencias')->group(function () {
    Route::get('/', [LicenciaController::class, 'index'])->name('licencias.index'); // Ver licencias
    Route::get('/create', [LicenciaController::class, 'create'])->name('licencias.create'); // Formulario para registrar licencia
    Route::post('/', [LicenciaController::class, 'store'])->name('licencias.store'); // Guardar licencia
    Route::get('/{licencia}/edit', [LicenciaController::class, 'edit'])->name('licencias.edit'); // Editar licencia
    Route::put('/{licencia}', [LicenciaController::class, 'update'])->name('licencias.update'); // Actualizar licencia
    Route::delete('/{licencia}', [LicenciaController::class, 'destroy'])->name('licencias.destroy'); // Eliminar licencia
});

Route::prefix('nomina')->group(function () {
    Route::get('/', [NominaController::class, 'index'])->name('nomina.index'); // Calcular sueldos
    Route::post('/store', [NominaController::class, 'store'])->name('nomina.store');
    Route::post('/aplicarDescuentos', [NominaController::class, 'aplicarDescuentos'])->name('nomina.aplicarDescuentos');//trabajando aqui-----
    Route::get('/filtro', [NominaController::class, 'filtro'])->name('nomina.filtro');
    Route::get('/filtro/boletas', [NominaController::class, 'filtroBoletas'])->name('nomina.filtro.boletas');
    Route::post('/guardarBoleta', [NominaController::class, 'guardarBoleta'])->name('nomina.guardarBoleta');


});
Route::prefix('boleta')->group(function () {//implementando todos los metodos
    Route::get('/', [boletaPagoController::class, 'index'])->name('boleta.index');
    Route::get('/show{empleado_id}', [boletaPagoController::class, 'show'])->name('boleta.show');
    Route::post('/store', [boletaPagoController::class, 'store'])->name('boleta.store');
});
Route::prefix('descuentos')->group(function () {
    Route::get('/create', [DescuentoController::class, 'create'])->name('descuentos.create'); // Calcular sueldos
    Route::get('/{id}/edit', [DescuentoController::class, 'edit'])->name('descuentos.edit');
    Route::put('/{id}', [DescuentoController::class, 'update'])->name('descuentos.update');
});


 /* AL MOMENTO DE FILTRAR POR CARNET DEBERIA DE MOSTRARME EN VER ASISTENCIA: 
 NOMBRE DEL EMPLEADO 
 DIAS TRABAJADOS 
 
 Y NO DEBERIA DE DUBLICARSE LA INFORMACION*/