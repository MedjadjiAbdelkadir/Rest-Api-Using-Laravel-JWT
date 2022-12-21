<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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


/*
|--------------------------------------------------------------------------
| Auth Routes :
|  /api/auth/register
|  /api/auth/login
|  /api/auth/user-profile
|  /api/auth/refresh
|  /api/auth/logout
|--------------------------------------------------------------------------
*/

Route::group(['namespace'=>'Api'] , function(){
    Route::get('/users', [AuthController::class, 'getUsesr']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware'=>['jwt.auth']], function(){
        Route::get('/user-profile', [AuthController::class, 'userProfile']);  
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/logout', [AuthController::class, 'logout']) ;


        Route::get('my_posts', [UserController::class, 'index']) ;
    });

});


