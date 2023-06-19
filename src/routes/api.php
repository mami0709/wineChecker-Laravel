<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultAkaController;
use App\Http\Controllers\ResultShiroWineController;
use App\Http\Controllers\RecommendController;

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

Route::get('/resultAkaWine', [ResultAkaController::class, 'index']);
Route::get('/resultShiroWine', [ResultShiroWineController::class, 'index']);
Route::get('/recommend', [RecommendController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
