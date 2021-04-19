<?php

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

Route::group(['prefix' => 'v1'], function(){


    #### Authentication routes #####
    Route::prefix('auth')->group(function () {
        Route::post('/login', 'AuthController@login')->name('auth.login');
        Route::post('/register', 'AuthController@register')->name('auth.register');
    });

    ######### Routes for logged user #########
    Route::middleware(['auth:sanctum'])->group(function () {
        #### Authentication routes #####
        Route::prefix('auth')->group(function () {
            Route::post('/logout', 'AuthController@logout')->name('auth.logout');
        });

        #### Tweet routes #####
        Route::resource('/tweets', 'TweetController');


        #### User routes #####
        Route::prefix('user')->group(function () {
            Route::post('/follow', 'UserController@follow')->name('user.follow');
        });
    });

    Route::get('/download-users-report', 'UserController@downloadUsersReport')->name('user.downloadUsersReport');


});
