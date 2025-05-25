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

Route::inertia('/auth/register', 'Website/Auth/Register')->name('register');

Route::inertia('/auth/login', 'Website/Auth/Login')->name('login');

Route::inertia('/auth/forget', 'Website/Auth/Forget')->name('forget');

Route::inertia('/auth/reset', 'Website/Auth/Reset')->name('password.reset');

Route::post('/auth/login', 'AuthenticationController@login')->name('post.login');

Route::post('/auth/register', 'AuthenticationController@register')->name('post.register');

Route::post('/auth/forget', 'AuthenticationController@forget')->name('post.forget');

Route::post('/auth/reset/save','AuthenticationController@resetAction')->name('post.reset');
