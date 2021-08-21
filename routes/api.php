<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\SexUsersDatasController;
use App\Http\Controllers\UsersDatasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DirectoresController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('register', 'App\Http\Controllers\AuthController@signUp');
// Route::post('login', 'App\Http\Controllers\AuthController@auth');

Route::resource('directores', DirectoresController::class);
Route::resource('movies', MoviesController::class);
Route::resource('scores', ScoresController::class);
Route::resource('seasons', SeasonsController::class);
Route::resource('series', SeriesController::class);
Route::resource('users', UsersController::class);
Route::resource('sex_users_datas', SexUsersDatasController::class);
Route::resource('users_datas', UsersDatasController::class);

Route::post('usersstore', [UsersController::class, 'store']);
Route::get('apidata/{title}/{year}', [ApiController::class, 'ApiData']);
// Route::put('users', [UsersController::class, 'update']);
// Route::get('users_show', [UserController::class, 'show']);
// Route::delete('users', [UserController::class, 'destroy']);

// Route::group(['middleware' => ['jwt.verify']], function() {
  
//     Route::get('users','App\Http\Controllers\AuthController@getAuthUser');
    
//   });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
