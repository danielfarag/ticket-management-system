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

    Route::get('/', 'DashboardController@index')->name('dashboard');
    
    Route::inertia('/import/{type}','Import')->name('import');
    
    Route::get('/export/{type}','ExportController@download')->name('export');
    
    Route::post('/import','ImportController@upload')->name('import.upload');

    Route::get('/services','ServiceController@index')->name('services.index');

    Route::post('/services', 'ServiceController@storeOrUpdate')->name('services.store');

    Route::get('/services/create', 'ServiceController@createOrEdit')->name('services.create');
    
    Route::get('/services/{service}','ServiceController@show')->name('services.show');
    
    Route::get('/services/{service}/edit','ServiceController@createOrEdit')->name('services.edit');

    Route::put('/services/{service}','ServiceController@storeOrUpdate')->name('services.update');
    
    Route::delete('/services/{service}','ServiceController@destroy')->name('services.destroy');



    Route::get('/sliders','SliderController@index')->name('sliders.index');

    Route::post('/sliders', 'SliderController@storeOrUpdate')->name('sliders.store');

    Route::get('/sliders/create', 'SliderController@createOrEdit')->name('sliders.create');
    
    Route::get('/sliders/{slider}','SliderController@show')->name('sliders.show');
    
    Route::get('/sliders/{slider}/edit','SliderController@createOrEdit')->name('sliders.edit');

    Route::put('/sliders/{slider}','SliderController@storeOrUpdate')->name('sliders.update');
    
    Route::delete('/sliders/{slider}','SliderController@destroy')->name('sliders.destroy');



    Route::get('/categories/{type}','CategoryController@index')->name('categories.index');

    Route::post('/categories/{type}', 'CategoryController@storeOrUpdate')->name('categories.store');

    Route::get('/categories/{type}/create', 'CategoryController@createOrEdit')->name('categories.create');
    
    Route::get('/categories/{type}/{category}','CategoryController@show')->name('categories.show');
    
    Route::get('/categories/{type}/{category}/edit','CategoryController@createOrEdit')->name('categories.edit');

    Route::put('/categories/{type}/{category}','CategoryController@storeOrUpdate')->name('categories.update');
    
    Route::delete('/categories/{type}/{category}','CategoryController@destroy')->name('categories.destroy');

    
    Route::get('/todos','TodoController@index')->name('todos.index');
    
    Route::post('/todos','TodoController@storeOrUpdate')->name('todos.store');
    
    Route::get('/todos/create','TodoController@createOrEdit')->name('todos.create');
    
    Route::get('/todos/{todo}','TodoController@show')->name('todos.show');
    
    Route::get('/todos/{todo}/edit','TodoController@createOrEdit')->name('todos.edit');
    
    Route::put('/todos/{todo}','TodoController@storeOrUpdate')->name('todos.update');
    
    Route::delete('/todos/{todo}','TodoController@destroy')->name('todos.destroy');

});
