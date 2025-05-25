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

Route::get('/notifications','ProfileController@notifications')->name('notifications');

Route::get('/me','ProfileController@me')->name('me');
    
Route::inertia('/me/update','Website/Profile/UpdateUser')->name('me.update');

Route::post('/me/update','AuthenticationController@updateProfile')->name('me.update.action');

Route::post('/me/update-password','AuthenticationController@updatePassword')->name('me.update-password.action');

Route::post('/logout','AuthenticationController@logout')->name('logout');



Route::get('/tickets','TicketController@index')->name('website.tickets.index');

Route::post('/tickets', 'TicketController@storeOrUpdate')->name('website.tickets.store');

Route::get('/tickets/create', 'TicketController@createOrEdit')->name('website.tickets.create');

Route::get('/tickets/{ticket}','TicketController@show')->name('website.tickets.show');

Route::get('/tickets/{ticket}/edit','TicketController@createOrEdit')->name('website.tickets.edit');

Route::get('/tickets/{ticket}/survey','TicketController@getSurvey')->name('website.tickes.survey');

Route::post('/tickets/{ticket}/survey','TicketController@rateTicket')->name('website.tickets.rate_ticket');

Route::put('/tickets/{ticket}','TicketController@storeOrUpdate')->name('website.tickets.update');

Route::delete('/tickets/{ticket}','TicketController@destroy')->name('website.tickets.destroy');

Route::post('/tickets/{ticket}/comment', 'TicketController@createComment')->name('website.tickets.create_comment');

Route::delete('/tickets/comments/{comment}','TicketController@deleteComment')->name('website.tickets.delete_comment');

Route::post('/knowledge/{article}/comment', 'ArticleController@createComment')->name('website.articles.create_comment');
    
Route::delete('/knowledge/comments/{comment}','ArticleController@deleteComment')->name('website.articles.delete_comment');

Route::post('/knowledge/{article}/useful', 'ArticleController@setUseful')->name('website.articles.set_useful');


