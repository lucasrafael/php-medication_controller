<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\UsuarioController;

use App\Http\Middleware\CheckURL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas abertas...
Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::get('/usuario/login', [UsuarioController::class, 'login'])->name('usuario.login');
Route::get('/usuario/logout', [UsuarioController::class, 'logout'])->name('usuario.logout');
Route::post('/usuario/logar', [UsuarioController::class, 'logar'])->name('usuario.logar');
Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');

Route::get('/marcas/medicamentos/{id}', [MarcaController::class, 'medicamentos'])->name('marcas.medicamentos');
Route::get('/marcas/remove/{id}', [MarcaController::class, 'remover'])->name('marcas.remove');

Route::get('/medicamentos/remove/{id}', [MedicamentoController::class, 'remover'])->name('medicamentos.remove');

Route::get('/categorias/remove/{id}', [CategoriaController::class, 'remover'])->name('categorias.remove');
Route::get('/categorias/medicamentos/{id}', [CategoriaController::class, 'medicamentos'])->name('categorias.medicamentos');

Route::get('/', function () {
    return redirect()->route('medicamentos.index');
})->name('controller.index');

// CRUD dos recursos abaixo tem as rotas para "insert", "update" e "delete" bloqueadas em caso de não haver sessão ativa.
Route::resource('medicamentos', MedicamentoController::class)->middleware(CheckURL::class);
Route::resource('categorias', CategoriaController::class)->middleware(CheckURL::class);
Route::resource('marcas', MarcaController::class)->middleware(CheckURL::class);
