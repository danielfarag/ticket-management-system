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

    Route::get('/users','UserController@index')->name('users.index');

    Route::post('/users', 'UserController@storeOrUpdate')->name('users.store');

    Route::get('/users/create', 'UserController@createOrEdit')->name('users.create');
    
    Route::get('/users/{user}','UserController@show')->name('users.show');
    
    Route::get('/users/{user}/edit','UserController@createOrEdit')->name('users.edit');

    Route::put('/users/{user}','UserController@storeOrUpdate')->name('users.update');
    
    Route::delete('/users/{user}','UserController@destroy')->name('users.destroy');


    Route::get('/roles','RoleController@index')->name('roles.index');

    Route::post('/roles', 'RoleController@storeOrUpdate')->name('roles.store');

    Route::get('/roles/create', 'RoleController@createOrEdit')->name('roles.create');
    
    Route::get('/roles/{role}','RoleController@show')->name('roles.show');
    
    Route::get('/roles/{role}/edit','RoleController@createOrEdit')->name('roles.edit');

    Route::put('/roles/{role}','RoleController@storeOrUpdate')->name('roles.update');
    
    Route::delete('/roles/{role}','RoleController@destroy')->name('roles.destroy');


    
    Route::inertia('/me','Auth/Me')->name('dashboard.me');
    
    Route::inertia('/me/update','Auth/Update')->name('dashboard.me.update');

    Route::inertia('/me/update-password','Auth/UpdatePassword')->name('dashboard.me.update-password');

    Route::post('/me/update','AuthenticationController@updateProfile')->name('dashboard.me.update.action');

    Route::post('/me/update-password','AuthenticationController@updatePassword')->name('dashboard.me.update-password.action');

    Route::post('/logout','AuthenticationController@logout')->name('dashboard.logout');
});