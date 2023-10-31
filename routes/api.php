<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HotelController;
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
// composer require fruitcake/laravel-cors -> для использования CORS
//но в kernel уже все есть!

Route::post('/signup', [RegistrationController::class, 'signup']); //->middleware('guest')
Route::post('/login', [LoginController::class, 'login']); //->middleware('guest')

Route::post('/room', [RoomsController::class, 'store'])->middleware('auth:sanctum');
Route::get('/rooms', [RoomsController::class, 'index'])->middleware('auth:sanctum');

Route::delete('/room/{id}', [RoomsController::class, 'delete'])->middleware('auth:sanctum');

Route::post('/register', [ClientController::class, 'register'])->middleware('auth:sanctum');

Route::patch('/userdata/{id}', [ClientController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/userdata/{id}', [ClientController::class, 'delete'])->middleware('auth:sanctum');

Route::get('/room/{id}/userdata/{iduser}', [ClientController::class, 'changeRoom'])->middleware('auth:sanctum');

Route::get('/userinroom', [RoomsController::class, 'userInRoom']);

Route::post('/hotel', [HotelController::class, 'store'])->middleware('auth:sanctum');
Route::get('/hotels', [HotelController::class, 'index'])->middleware('auth:sanctum');
Route::delete('/hotel/{id}', [HotelController::class, 'delete'])->middleware('auth:sanctum');

Route::fallback(function () { // обработка не прошедших маршрутов
    return response()->json(
        [
            "message" => [
                "error" => "Page not found"
            ]
        ],
        404
    );
});
