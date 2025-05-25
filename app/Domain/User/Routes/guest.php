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

Route::prefix('dashboard')->group(function(){

    Route::inertia('/auth/register', 'Auth/Register')->name('dashboard.register');
    
    Route::inertia('/auth/login', 'Auth/Login')->name('dashboard.login');
    
    Route::inertia('/auth/forget', 'Auth/Forget')->name('dashboard.forget');

    Route::inertia('/auth/reset', 'Auth/Reset')->name('dashboard.password.reset');
    
    Route::post('/auth/login', 'AuthenticationController@login')->name('dashboard.post.login');
    
    Route::post('/auth/register', 'AuthenticationController@register')->name('dashboard.post.register');
    
    Route::post('/auth/forget', 'AuthenticationController@forget')->name('dashboard.post.forget');

    Route::post('/auth/reset/save','AuthenticationController@resetAction')->name('dashboard.post.reset');
});
