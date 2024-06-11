<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RutController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\GraficosController;
use App\Http\Controllers\TercerosController;

//para acceder a cuentas controller
use App\Http\Controllers\planCuentasController;
use App\Http\Controllers\casoscontroller;



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



//ruta para solicitud de asistencia
Route::get('/ayuda', function () {
    return view('/modulos/asistencia/solicitudAsistencia');
})->name('solicitud');

//ruta para testimonios
Route::get('/testimonios', function () {
    return view('/modulos/asistencia/testimonios');
})->name('testimonios');


//ruta para index de asistencia
Route::get('/index1', function () {
    return view('/modulos/asistencia/index');
})->name('index');

//ruta para la solicitud de caso
Route::post('/ayuda', [casoscontroller::class, 'registrarCaso']);



//valida que se cumpla la condicion de que esten logueados, antes de acceder a una de estas rutas 
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard']);

    Route::get('/index', [HomeController::class, 'index']);

    Route::get('/', [HomeController::class, 'index']);
    
    Route::get('/homevanilla', function () {
        return view('/plantillaVanila/vanillahome');
    })->name('vanilla');
    
    //ruta para plan de cuentas
    Route::get('/cuentas', [planCuentasController::class, 'index'])->name('cuentas');
    //para enviar a la vista

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/logout', [LogoutController::class, 'logout']);
    
    Route::get('/deudas', [HomeController::class, 'deudas'])->middleware('auth');
    
    Route::get('/tablaDeudas', [DataController::class, 'tablaDeudas'])->name('data.tablaDeudas');
    
    Route::get('/deuda/{id}/edit', [DataController::class, 'edit'])->name('deuda.edit');
    
    Route::put('/deuda/{id}/update', [DataController::class, 'update'])->name('deuda.update');
    Route::post('/deuda/{id}/update', [DataController::class, 'update'])->name('deuda.update');
    Route::get('/deuda/{id}', [DataController::class, 'destroy'])->name('deuda.destroy');
    Route::get('/crearDeuda', [DataController::class, 'create'])->name('deuda.create');
    Route::post('/crearDeuda', [DataController::class, 'store'])->name('deuda.store');
    
    Route::get('/pagar', [DataController::class, 'pagar']);

    //Rutas del rut
    
    Route::get('/obtenerRut', [RutController::class, 'index'])->middleware(['check.permisos: 1']);;
    Route::post('/formularioObtenerRut', [RutController::class, 'obtenerRut']);

    //Rutas del ticket

    Route::get('/ticketsIndex', [TicketsController::class, 'index'])->name('tickets.index');
    Route::get('/tickets', [TicketsController::class, 'getDatosDataTable'])->name('tickets.dataTable');
    Route::post('/showTicket/{idCaso}', [TicketsController::class, 'showTicket'])->name('tickets.showTicket');
    
    //Manejo de archivos

    Route::post('/file/uploadImagenAsesor', [ArchivosController::class, 'storeImagenAsesor'])->name('file.uploadImagenAsesor');
    Route::get('/imagenesAsesor', [ArchivosController::class, 'getImagenesAsesorDataTable'])->name('imagenesAsesor.dataTable');

    //Rutas de graficos

    Route::get('/graficosIndex', [GraficosController::class, 'index'])->name('grafico.index');
    Route::get('/graficosMapas', [GraficosController::class, 'indexMapa'])->name('grafico.indexMapa');

    //Rutas de terceros
    
    Route::get('/tercerosIndex', [TercerosController::class, 'index'])->name('terceros.index');
    Route::get('/tercerosDatatable', [TercerosController::class, 'getDatosDataTable'])->name('terceros.dataTable');
    Route::get('/showTercero/{tercero}', [TercerosController::class, 'showTercero'])->name('terceros.show');
    Route::get('/crearTercero', [TercerosController::class, 'crearTercero'])->name('terceros.crear');
    Route::post('/terceros/guardar', [TercerosController::class, 'store'])->name('terceros.guardar');
    Route::put('/terceros/update/{tercero}', [TercerosController::class, 'update'])->name('terceros.update');
    Route::delete('/terceros/delete/{tercero}', [TercerosController::class, 'delete'])->name('terceros.delete');

});

use App\Http\Controllers\MetodoDePagoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\FacturasController;

Route::middleware(['auth'])->group(function () {
    //Metodos de pago
    Route::resource('metodos_de_pago', MetodoDePagoController::class);

    //Usuarios y permisos
    Route::get('/register', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/register', [UsuariosController::class, 'store']);
    Route::get('/usuarios/index', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuariosDT', [UsuariosController::class, 'getDatosDataTable'])->name('usuarios.dataTable');
    Route::post('/usuarios/toggle/{id}', [UsuariosController::class, 'toggle'])->name('usuarios.toggle');
    Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::post('/usuarios/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/permissions/{id}', [UsuariosController::class, 'permissions'])->name('usuarios.permissions');
    Route::post('/usuarios/permissions/{id}', [UsuariosController::class, 'updatePermissions'])->name('usuarios.updatePermissions');

    //Facturas

    Route::get('/facturas/permissions', [FacturasController::class, 'create'])->name('facturas.create');
    Route::post('/factura/check-or-create', [FacturasController::class, 'checkOrCreate']);
    Route::post('/pago-factura/register', [FacturasController::class, 'registarPago']);


});






Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/indexController', [PermisosController::class, 'index'])->name('indexController');