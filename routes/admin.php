<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::resource('empresas', EmpresaController::class)->names('admin.empresas');
Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores');
Route::resource('rubros', RubroController::class)->names('admin.rubros');
Route::resource('productos', ProductoController::class)->names('admin.productos');
Route::resource('clientes', ClienteController::class)->names('admin.clientes');
Route::resource('obras', ObraController::class)->names('admin.obras');
Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios');
Route::resource('ordenes', OrdenController::class)->names('admin.ordenes');