<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenController;
use App\Mail\EnviaOrden;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


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

Route::get('/', function () {
    return redirect()->route('admin.ordenes.index');
})->middleware('auth');

Route::get('/mail', function () {
    Mail::to('ezequielmx@gmail.com')->send(new EnviaOrden('ordenes@chillersystem.com', 'Chiller System', 27, ''));
    return 'Mensaje enviado 2';
})->name('mail');