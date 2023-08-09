<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::resource('empresas', EmpresaController::class)->names('admin.empresas');
Route::resource('proveedores', ProveedorController::class)->names('admin.proveedores');