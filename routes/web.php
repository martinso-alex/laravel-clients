<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

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

Route::get('/', function () {
  return view('welcome');
});

Route::get('clientes', [ClientesController::class, 'index']);
Route::post('clientes', [ClientesController::class, 'index']);
Route::get('clientes/adicionar', [ClientesController::class, 'create']);
Route::get('clientes/{id}', [ClientesController::class, 'show']);
Route::post('clientes/adicionar', [ClientesController::class, 'store']);
