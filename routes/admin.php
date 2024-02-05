<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::resource('empresas', EmpresaController::class)->names('admin.empresas')->middleware('can:empresas');
Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores')->middleware('can:proveedores');
Route::resource('rubros', RubroController::class)->names('admin.rubros')->middleware('can:rubrros');
Route::resource('productos', ProductoController::class)->names('admin.productos')->middleware('can:productos');
Route::resource('clientes', ClienteController::class)->names('admin.clientes')->middleware('can:clientes');;
Route::resource('obras', ObraController::class)->names('admin.obras')->middleware('can:obras');;
Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios')->middleware('can:usuarios');;
Route::resource('ordenes', OrdenController::class)->names('admin.ordenes');
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('can:dash');;
Route::get('ordenes/{orden}/print', [OrdenController::class, 'print'])->name('admin.ordenes.print');