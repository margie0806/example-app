<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/empleado', [EmpleadoController::class,'store'])->name('empleado.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/empleado', function(){
    return view('empleado.index');
    })->name('empleado.index');
    Route::get('/agendacita', function(){
    return view('agendacita.index');
    })->name('agendacita.index');
    Route::get('/citasAgendadas', function(){
    return view('citasAgendadas.index');
    })->name('citasAgendadas.index');

    
    Route::delete('/deleteEmpleado/{id}', [EmpleadoController::class,'destroy'])->name('deleteEmpleado.destroy');


    Route::get('/editarEmpleados/{id}',[EmpleadoController::class,'mostrarEdit'])->name('editarEmpleados.index');


    Route::put('/updatempleado/{id}',[EmpleadoController::class,'update'])->name('updatempleado.update');

    Route::get('/listaEmpleado', function(){
    return view('listaEmpleado.index');
    })->name('listaEmpleado.index');
    Route::get('/listaEmpleado', [EmpleadoController::class, 'show'])->name('listaEmpleado.index');
    
});

require __DIR__.'/auth.php';
