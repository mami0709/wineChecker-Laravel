<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultAkaController;
use App\Http\Controllers\ResultShiroWineController;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\AuthController;

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
Route::get('/recommend/{id}', [RecommendController::class, 'show']);
Route::post('/newPost', [RecommendController::class, 'store']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/userInfo/getUser', [AuthController::class, 'getUser']);
Route::post('/userInfo/updateUser', [AuthController::class, 'updateUser']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
