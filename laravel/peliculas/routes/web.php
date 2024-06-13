<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlquileresAdminController;
use App\Http\Controllers\Admin\CalificacionesAdminController;
use App\Http\Controllers\Admin\PeliculasAdminController;
use App\Http\Controllers\Admin\UsuariosAdminController;
use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MisPeliculasController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [HomeController::class, 'index'])->name('home');

//No quito ruta dashboard porque sino las rutas profile no funcionan
//Quitar si me da problemas
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::resource('admin/usuarios', UsuariosAdminController::class)->names('admin.usuarios');
    Route::resource('admin/peliculas', PeliculasAdminController::class)->names('admin.peliculas');
    Route::resource('admin/alquileres', AlquileresAdminController::class)->names('admin.alquileres')
        ->parameters(['alquileres' => 'alquiler']);
    Route::resource('admin/calificaciones', CalificacionesAdminController::class)->names('admin.calificaciones')
        ->parameters(['calificaciones' => 'calificacion']);


    Route::post('admin/clientes/filtro', [UsuariosAdminController::class, 'filtro'])->name('admin.usuarios.filtro');
    Route::post('admin/peliculas/filtro', [PeliculasAdminController::class, 'filtro'])->name('admin.peliculas.filtro');

    Route::get('admin/index', [AdminController::class, 'index'])->name('admin.index');



});
Route::middleware('auth')->group(function (){
    Route::resource('alquiler', AlquilerController::class)->names('alquiler');
    Route::resource('calificacion', CalificacionController::class)->names('calificacion');
    Route::resource('pelicula', PeliculasController::class)->names('pelicula');
    Route::get('mis-peliculas', [MisPeliculasController::class, 'index'])->name('mis-peliculas');
    Route::get('peliculas', [PeliculasController::class, 'index'])->name('peliculas');

});
require __DIR__.'/auth.php';
