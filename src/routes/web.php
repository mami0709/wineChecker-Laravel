<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultAkaController;
use App\Http\Controllers\ResultShiroWineController;

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
    return view('welcome');
});
// Route::get('/resultAkaWine', [ResultAkaController::class, 'index']);
// Route::get('/resultShiroWine', [ResultShiroWineController::class, 'index']);


// Route::get('shindan/resultAka', 'resultAkaController@index'); //localhost:8000/resultAka へのルーティング
// Route::get('shindan/resultShiro', 'resultShiroController@index');
// Route::get('shindan/recommend', 'recommendController@index');
// Route::get('shindan/recommend/{id}', 'recommendController@show');
// Route::post('newPost', 'newPostController@store');
// Route::post('newPost/PostComplete', 'PostCompleteController@store');
// Route::post('login/userInfo', 'userInfoController@update');
// Route::post('login', 'loginController@store');
// Route::post('login/Signup', 'SignupController@store');
