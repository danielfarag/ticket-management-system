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

Route::get('/','HomeController@index')->name('home');

Route::inertia('/contact','Website/Contact')->name('contact');

Route::post('/contact','ContactController@send')->name('contact.submit');

Route::get('/about','AboutController@index')->name('about');

Route::get('/terms','TermsController@index')->name('terms');

Route::get('/features','FeatureController@index')->name('features');

Route::get('/privacy','PrivacyController@index')->name('privacy');

Route::get('/team_members','TeamMembersController@index')->name('team_members');


Route::get('/faq/search','FaqController@search')->name('faqs.search');

Route::get('/faq/category/{id?}','FaqController@index')->name('faqs.department');


Route::get('/knowledge','ArticleController@index')->name('knowledge.index');

Route::get('/knowledge/search','ArticleController@search')->name('knowledge.search');

Route::get('/knowledge/category/{id}','ArticleController@category')->name('knowledge.category');

Route::get('/knowledge/{article}','ArticleController@show')->name('knowledge.show');



Route::inertia('/blocked','Website/Blocked')->name('blocked');
