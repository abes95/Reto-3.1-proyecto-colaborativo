<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\FacturalineasController;
use Illuminate\Support\Facades\File;



Route::get('/', function () {
    return view('auth.login');
});
/*
Route::get('/clientes', function () {
    return view('clientes.index');
});
/*
Route::get('/clientes/create', function () {
    return view('clientes.create');
});

Route::get('/clientes/edit', function () {
    return view('clientes.edit');
});
*/

Route::resource('clientes', ClientesController::class)->middleware('auth');


Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});


// Route resource for 'clientes' is already declared above

Route::get('/facturas/cliente/{id}', [FacturasController::class, 'facturascliente'])->middleware('auth');

// Rutas para líneas de factura
Route::get('/facturas/{id}/lineas', [FacturalineasController::class, 'index'])->name('facturas.lineas')->middleware('auth');
Route::get('/facturas/{id}/lineas/create', [FacturalineasController::class, 'create'])->name('facturas.lineas.create')->middleware('auth');
Route::post('/facturalineas', [FacturalineasController::class, 'store'])->name('facturalineas.store')->middleware('auth');
Route::get('/facturalineas/{id}/edit', [FacturalineasController::class, 'edit'])->name('facturalineas.edit')->middleware('auth');
Route::put('/facturalineas/{id}', [FacturalineasController::class, 'update'])->name('facturalineas.update')->middleware('auth');
Route::delete('/facturalineas/{id}', [FacturalineasController::class, 'destroy'])->name('facturalineas.destroy')->middleware('auth');

Route::resource('facturas', FacturasController::class)->middleware('auth');