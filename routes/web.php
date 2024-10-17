<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas públicas para la creación de empleados y citas
Route::post('/empleado', [EmpleadoController::class, 'store'])->name('empleado.store');
Route::post('/agendacita', [AgendaController::class, 'store'])->name('agendacita.store');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Ruta del dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para el perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vistas relacionadas con empleados
    Route::get('/empleado', function() {
        return view('empleado.index');
    })->name('empleado.index');

    Route::get('/listaEmpleado', [EmpleadoController::class, 'show'])->name('listaEmpleado.index');
    Route::get('/citasAgendadas', [AgendaController::class, 'show'])->name('citasAgendadas.index');

    // Rutas para manejar empleados (editar, actualizar y eliminar)
    Route::get('/editarEmpleados/{id}', [EmpleadoController::class, 'mostrarEdit'])->name('editarEmpleados.index');
    Route::put('/updatempleado/{id}', [EmpleadoController::class, 'update'])->name('updatempleado.update');
    Route::delete('/deleteEmpleado/{id}', [EmpleadoController::class, 'destroy'])->name('deleteEmpleado.destroy');

    // Rutas relacionadas con la agenda de citas
    Route::get('/agendacita', [AgendaController::class, 'index'])->name('agendacita.index');
    
});

// Autenticación (rutas generadas por Laravel)
require __DIR__ . '/auth.php';
