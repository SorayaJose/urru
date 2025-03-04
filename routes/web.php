<?php

use App\Models\TipoConvenio;
use App\Http\Livewire\Mostrar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\CandidatosController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\TipoConvenioController;

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

Route::get('/', HomeController::class)->name('home');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::get('/dashboard', [VacanteController::class, 'index'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('vacantes.index');
Route::get('/vacantes/create', [VacanteController::class, 'create'])->middleware(['auth', 'verified'])->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])->middleware(['auth', 'verified'])->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])->name('vacantes.show');

Route::get('/candidatos/{vacante}', [CandidatosController::class, 'index'])->name('candidatos.index');

Route::get('/apartamentos', [ApartamentoController::class, 'index'])->middleware(['auth', 'verified'])->name('apartamentos.index');
Route::get('/apartamentos/create', [ApartamentoController::class, 'create'])->middleware(['auth', 'verified'])->name('apartamentos.create');
Route::get('/apartamentos/{apartamento}', [ApartamentoController::class, 'show'])->name('apartamentos.show');
Route::get('/apartamentos/{apartamento}/edit', [ApartamentoController::class, 'edit'])->middleware(['auth', 'verified'])->name('apartamentos.edit');

Route::get('/recibos', [ReciboController::class, 'index'])->middleware(['auth', 'verified'])->name('recibos.index');
Route::get('/recibos/create', [ReciboController::class, 'create'])->middleware(['auth', 'verified'])->name('recibos.create');
Route::get('/recibos/{recibo}', [ReciboController::class, 'show'])->name('recibos.show');
//Route::get('/recibos/{recibo}/edit', [ReciboController::class, 'edit'])->middleware(['auth', 'verified'])->name('personas.edit');

Route::get('/gastos', [GastoController::class, 'index'])->middleware(['auth', 'verified'])->name('gastos.index');
Route::get('/gastos/create', [GastoController::class, 'create'])->middleware(['auth', 'verified'])->name('gastos.create');
Route::get('/gastos/createIna', [GastoController::class, 'createIna'])->middleware(['auth', 'verified'])->name('gastos.createIna');
Route::get('/gastos/{gasto}', [GastoController::class, 'show'])->name('gastos.show');
Route::get('/gastos/{gasto}/edit', [GastoController::class, 'edit'])->middleware(['auth', 'verified'])->name('gastos.edit');

Route::get('/personas', [PersonaController::class, 'index'])->middleware(['auth', 'verified'])->name('personas.index');
Route::get('/personas/create', [PersonaController::class, 'create'])->middleware(['auth', 'verified'])->name('personas.create');
Route::get('/personas/{persona}', [PersonaController::class, 'show'])->name('personas.show');
Route::get('/personas/{persona}/edit', [PersonaController::class, 'edit'])->middleware(['auth', 'verified'])->name('personas.edit');

Route::get('/convenios', [ConvenioController::class, 'index'])->middleware(['auth', 'verified'])->name('convenios.index');
Route::get('/convenios/{convenio}', [ConvenioController::class, 'show'])->name('convenios.show');
Route::get('/convenios/{socio}/create', [ConvenioController::class, 'create'])->middleware(['auth', 'verified'])->name('convenios.create');
Route::get('/convenios/{convenio}/edit', [ConvenioController::class, 'edit'])->middleware(['auth', 'verified'])->name('convenios.edit');

Route::get('/socios', [SocioController::class, 'index'])->middleware(['auth', 'verified'])->name('socios.index');
Route::get('/socios/create', [SocioController::class, 'create'])->middleware(['auth', 'verified'])->name('socios.create');
Route::get('/socios/{socio}', [SocioController::class, 'show'])->name('socios.show');
Route::get('/socios/{socio}/edit', [SocioController::class, 'edit'])->middleware(['auth', 'verified'])->name('socios.edit');

Route::get('/locales', [LocalController::class, 'index'])->middleware(['auth', 'verified'])->name('locales.index');
Route::get('/locales/create', [LocalController::class, 'create'])->middleware(['auth', 'verified'])->name('locales.create');
Route::get('/locales/{local}', [LocalController::class, 'show'])->name('locales.show');
Route::get('/locales/{local}/edit', [LocalController::class, 'edit'])->middleware(['auth', 'verified'])->name('locales.edit');

Route::get('/rubros', [RubroController::class, 'index'])->middleware(['auth', 'verified'])->name('rubros.index');
Route::get('/rubros/create', [RubroController::class, 'create'])->middleware(['auth', 'verified'])->name('rubros.create');
Route::get('/rubros/{rubro}', [RubroController::class, 'show'])->name('rubros.show');
Route::get('/rubros/{rubro}/edit', [RubroController::class, 'edit'])->middleware(['auth', 'verified'])->name('rubros.edit');

Route::get('/items', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->middleware(['auth', 'verified'])->name('items.create');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->middleware(['auth', 'verified'])->name('items.edit');

Route::get('/parametros', [ParametroController::class, 'index'])->middleware(['auth', 'verified'])->name('parametros.index');
//Route::get('/parametros/create', [ParametroController::class, 'create'])->middleware(['auth', 'verified'])->name('parametros.create');
//Route::get('/parametros/{parametro}', [ParametroController::class, 'show'])->name('parametros.show');
Route::get('/parametros/{parametro}/edit', [ParametroController::class, 'edit'])->middleware(['auth', 'verified'])->name('parametros.edit');

Route::get('/tipoConvenios', [TipoConvenioController::class, 'index'])->middleware(['auth', 'verified'])->name('tipoConvenios.index');
Route::get('/tipoConvenios/create', [TipoConvenioController::class, 'create'])->middleware(['auth', 'verified'])->name('tipoConvenios.create');
Route::get('/tipoConvenios/{rubro}', [TipoConvenioController::class, 'show'])->name('tipoConvenios.show');
Route::get('/tipoConvenios/{rubro}/edit', [TipoConvenioController::class, 'edit'])->middleware(['auth', 'verified'])->name('tipoConvenios.edit');
// Notificaciones
Route::get('/notificaciones', [NotificacionController::class, 'mostrar'])->middleware(['auth', 'verified', 'rol.reclutador'])->name('notificaciones');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
