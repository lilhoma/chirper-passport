<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\UserController;
// use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Api\ChirpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:api');

// Route::get('/chirps', [ChirpController::class, 'index']) ->name('chirps.index');
// Route::post('/chirps', [ChirpController::class, 'store']) ->name('chirps.store') -> middleware(['auth:api']);

Route::resource('chirps', ChirpController::class) 
    ->only(['index', 'store','edit', 'update' , 'destroy'])
    ->middleware(['auth:api']);


// Route::get('/user/chirps', function (){
//     return auth() -> user() -> chirps;
// })->middleware('auth:api');