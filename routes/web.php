<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/equipos/index', [EquipoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/equipos/crear', [EquipoController::class, 'create'])->name('equipos.create');
Route::post('/equipos/crear', [EquipoController::class, 'store'])->name('equipos.store');

Route::get('/equipos/{id}/editar', [EquipoController::class, 'edit'])->name('equipos.edit')->whereNumber('id');
Route::put('/equipos/{id}/editar', [EquipoController::class, 'update'])->name('equipos.update')->whereNumber('id');

Route::get('/equipos/{id}/ver', [EquipoController::class, 'show'])->name('equipos.show')->whereNumber('id');

Route::delete('/equipos/{id}/eliminar', [EquipoController::class, 'destroy'])->name('equipos.destroy')->whereNumber('id');


Route::get('/jugadores/index', [JugadorController::class, 'index'])->name('jugadores.index');

Route::get('/jugadores/crear', [JugadorController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores/crear', [JugadorController::class, 'store'])->name('jugadores.store');

Route::get('/jugadores/{id}/editar', [JugadorController::class, 'edit'])->name('jugadores.edit')->whereNumber('id');
Route::put('/jugadores/{id}/editar', [JugadorController::class, 'update'])->name('jugadores.update')->whereNumber('id');

Route::get('/jugadores/{id}/ver', [JugadorController::class, 'show'])->name('jugadores.show')->whereNumber('id');

Route::delete('/jugadores/{id}/eliminar', [JugadorController::class, 'destroy'])->name('jugadores.destroy')->whereNumber('id');
