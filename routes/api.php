<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoomsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//$response->header('Content-Type', 'application/json; charset=UTF-8');

Route::post('/signup', [RegistrationController::class, 'signup']); //->middleware('guest')
Route::post('/login', [LoginController::class, 'login']); //->middleware('guest')

Route::post('/room', [RoomsController::class, 'store'])->middleware('auth:sanctum');
Route::get('/rooms', [RoomsController::class, 'index'])->middleware('auth:sanctum');
