<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::resource('empresas', EmpresaController::class)->names('admin.empresas');
Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores');
Route::resource('rubros', RubroController::class)->names('admin.rubros');
Route::resource('productos', ProductoController::class)->names('admin.productos');