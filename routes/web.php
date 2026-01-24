<?php

use App\Http\Livewire\Mostrar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PistaController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PatinadorController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('homeUrru');
});
*/

Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home.index');


//Route::get('/cambioModo', [HomeController::class, 'cambioModo'])->middleware(['auth', 'verified'])->name('home.cambioModo');

Route::get('/categorias', [CategoriaController::class, 'index'])->middleware(['auth', 'verified'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->middleware(['auth', 'verified'])->name('categorias.create');
Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->middleware(['auth', 'verified'])->name('categorias.edit');

Route::get('/pistas', [PistaController::class, 'index'])->middleware(['auth', 'verified'])->name('pistas.index');
Route::get('/pistas/create', [PistaController::class, 'create'])->middleware(['auth', 'verified'])->name('pistas.create');
Route::get('/pistas/{pista}', [PistaController::class, 'show'])->name('pistas.show');
Route::get('/pistas/{pista}/edit', [PistaController::class, 'edit'])->middleware(['auth', 'verified'])->name('pistas.edit');

Route::get('/escuelas', [EscuelaController::class, 'index'])->middleware(['auth', 'verified'])->name('escuelas.index');
Route::get('/escuelas/create', [EscuelaController::class, 'create'])->middleware(['auth', 'verified'])->name('escuelas.create');
Route::get('/escuelas/{escuela}', [EscuelaController::class, 'show'])->name('escuelas.show');
Route::get('/escuelas/{escuela}/edit', [EscuelaController::class, 'edit'])->middleware(['auth', 'verified'])->name('escuelas.edit');

Route::get('/patinadores', [PatinadorController::class, 'index'])->middleware(['auth', 'verified'])->name('patinadores.index');
Route::get('/patinadores/create', [PatinadorController::class, 'create'])->middleware(['auth', 'verified'])->name('patinadores.create');
Route::get('/patinadores/{patinador}', [PatinadorController::class, 'show'])->name('patinadores.show');
Route::get('/patinadores/{patinador}/edit', [PatinadorController::class, 'edit'])->middleware(['auth', 'verified'])->name('patinadores.edit');


Route::get('/torneos', [TorneoController::class, 'index'])->middleware(['auth', 'verified'])->name('torneos.index');
Route::get('/torneos/create', [TorneoController::class, 'create'])->middleware(['auth', 'verified'])->name('torneos.create');
Route::get('/torneos/{torneo}', [TorneoController::class, 'show'])->name('torneos.show');
Route::get('/torneos/{torneo}/edit', [TorneoController::class, 'edit'])->middleware(['auth', 'verified'])->name('torneos.edit');
Route::get('/torneos', [TorneoController::class, 'index'])->middleware(['auth', 'verified'])->name('torneos.index');

// Notificaciones
Route::get('/notificaciones', [NotificacionController::class, 'mostrar'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
