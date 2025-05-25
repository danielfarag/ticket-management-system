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


    Route::get('/articles','ArticleController@index')->name('articles.index');

    Route::post('/articles', 'ArticleController@storeOrUpdate')->name('articles.store');

    Route::get('/articles/create', 'ArticleController@createOrEdit')->name('articles.create');
    
    Route::get('/articles/{article}','ArticleController@show')->name('articles.show');
    
    Route::get('/articles/{article}/edit','ArticleController@createOrEdit')->name('articles.edit');

    Route::put('/articles/{article}','ArticleController@storeOrUpdate')->name('articles.update');
    
    Route::delete('/articles/{article}','ArticleController@destroy')->name('articles.destroy');



    
    Route::get('/faqs','FaqController@index')->name('faqs.index');

    Route::post('/faqs', 'FaqController@storeOrUpdate')->name('faqs.store');

    Route::get('/faqs/create', 'FaqController@createOrEdit')->name('faqs.create');
    
    Route::get('/faqs/{faq}','FaqController@show')->name('faqs.show');
    
    Route::get('/faqs/{faq}/edit','FaqController@createOrEdit')->name('faqs.edit');

    Route::put('/faqs/{faq}','FaqController@storeOrUpdate')->name('faqs.update');
    
    Route::delete('/faqs/{faq}','FaqController@destroy')->name('faqs.destroy');

});
