<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\InformationsPersonnellesController;
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



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/storeInformationsPersonnelles', [InformationsPersonnellesController::class, 'store']);
Route::get('/indexinfo', [InformationsPersonnellesController::class, 'index']);


