<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MetodoDePagoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;



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

Route::get('/', [LoginController::class, 'show']);
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'dashboard']);

    //Metodos de pago
    Route::resource('metodos_de_pago', MetodoDePagoController::class)->middleware(['check.permisos: 5']);

    //Usuarios y permisos
    Route::get('/register', [UsuariosController::class, 'create'])->name('usuarios.create')->middleware(['check.permisos: 6']);
    Route::post('/register', [UsuariosController::class, 'store'])->middleware(['check.permisos: 6']);
    Route::get('/usuarios/index', [UsuariosController::class, 'index'])->name('usuarios.index')->middleware(['check.permisos: 6']);
    Route::get('/usuariosDT', [UsuariosController::class, 'getDatosDataTable'])->name('usuarios.dataTable')->middleware(['check.permisos: 6']);
    Route::post('/usuarios/toggle/{id}', [UsuariosController::class, 'toggle'])->name('usuarios.toggle')->middleware(['check.permisos: 6']);
    Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit')->middleware(['check.permisos: 6']);
    Route::post('/usuarios/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update')->middleware(['check.permisos: 6']);
    Route::get('/usuarios/permissions/{id}', [UsuariosController::class, 'permissions'])->name('usuarios.permissions')->middleware(['check.permisos: 6']);
    Route::post('/usuarios/permissions/{id}', [UsuariosController::class, 'updatePermissions'])->name('usuarios.updatePermissions')->middleware(['check.permisos: 6']);

    //Facturas

    Route::get('/facturas/permissions', [FacturasController::class, 'create'])->name('facturas.create')->middleware(['check.permisos: 1']);
    Route::post('/factura/check-or-create', [FacturasController::class, 'checkOrCreate'])->middleware(['check.permisos: 1']);
    Route::post('/pago-factura/register', [FacturasController::class, 'registarPago'])->middleware(['check.permisos: 1']);

});