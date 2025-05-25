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

    Route::get('/departments','DepartmentController@index')->name('departments.index');

    Route::post('/departments', 'DepartmentController@storeOrUpdate')->name('departments.store');

    Route::get('/departments/create', 'DepartmentController@createOrEdit')->name('departments.create');
    
    Route::get('/departments/{department}','DepartmentController@show')->name('departments.show');
    
    Route::get('/departments/{department}/edit','DepartmentController@createOrEdit')->name('departments.edit');

    Route::put('/departments/{department}','DepartmentController@storeOrUpdate')->name('departments.update');
    
    Route::delete('/departments/{department}','DepartmentController@destroy')->name('departments.destroy');

    Route::post('/departments_assign_agents/{department}','DepartmentController@assignAgents')->name('departments.assign_agents');

    Route::post('/departments_deassign_agents/{department}','DepartmentController@deassignAgents')->name('departments.deassign_agents');



    Route::get('/escalations','EscalationController@index')->name('escalations.index');

    Route::post('/escalations', 'EscalationController@storeOrUpdate')->name('escalations.store');

    Route::get('/escalations/create', 'EscalationController@createOrEdit')->name('escalations.create');
    
    Route::get('/escalations/{escalation}','EscalationController@show')->name('escalations.show');
    
    Route::get('/escalations/{escalation}/edit','EscalationController@createOrEdit')->name('escalations.edit');

    Route::put('/escalations/{escalation}','EscalationController@storeOrUpdate')->name('escalations.update');
    
    Route::delete('/escalations/{escalation}','EscalationController@destroy')->name('escalations.destroy');

    Route::post('/escalations/{escalation}/comment', 'EscalationController@createComment')->name('escalations.create_comment');
    
    Route::delete('/escalations/comments/{comment}','EscalationController@deleteComment')->name('escalations.delete_comment');


    Route::get('/severities','SeverityController@index')->name('severities.index');

    Route::post('/severities', 'SeverityController@storeOrUpdate')->name('severities.store');

    Route::get('/severities/create', 'SeverityController@createOrEdit')->name('severities.create');
    
    Route::get('/severities/{severity}','SeverityController@show')->name('severities.show');
    
    Route::get('/severities/{severity}/edit','SeverityController@createOrEdit')->name('severities.edit');

    Route::put('/severities/{severity}','SeverityController@storeOrUpdate')->name('severities.update');
    
    Route::delete('/severities/{severity}','SeverityController@destroy')->name('severities.destroy');



    Route::get('/statuses','StatusController@index')->name('statuses.index');

    Route::post('/statuses', 'StatusController@storeOrUpdate')->name('statuses.store');

    Route::get('/statuses/create', 'StatusController@createOrEdit')->name('statuses.create');
    
    Route::get('/statuses/{status}','StatusController@show')->name('statuses.show');
    
    Route::get('/statuses/{status}/edit','StatusController@createOrEdit')->name('statuses.edit');

    Route::put('/statuses/{status}','StatusController@storeOrUpdate')->name('statuses.update');
    
    Route::delete('/statuses/{status}','StatusController@destroy')->name('statuses.destroy');




    Route::get('/surveys','SurveyController@index')->name('surveys.index');

    Route::get('/surveys/{survey}','SurveyController@show')->name('surveys.show');
    
    Route::delete('/surveys/{survey}','SurveyController@destroy')->name('surveys.destroy');



    Route::get('/tickets','TicketController@index')->name('tickets.index');

    Route::post('/tickets', 'TicketController@storeOrUpdate')->name('tickets.store');

    Route::get('/tickets/create', 'TicketController@createOrEdit')->name('tickets.create');
    
    Route::get('/tickets/{ticket}','TicketController@show')->name('tickets.show');
    
    Route::get('/tickets/{ticket}/edit','TicketController@createOrEdit')->name('tickets.edit');

    Route::put('/tickets/{ticket}','TicketController@storeOrUpdate')->name('tickets.update');
    
    Route::delete('/tickets/{ticket}','TicketController@destroy')->name('tickets.destroy');



    Route::post('/tickets/{ticket}/survey', 'TicketController@sendSurvey')->name('tickets.send_survey');

    Route::post('/tickets/{ticket}/comment', 'TicketController@createComment')->name('tickets.create_comment');
    
    Route::delete('/tickets/comments/{comment}','TicketController@deleteComment')->name('tickets.delete_comment');

    Route::post('/tickets/{ticket}/note', 'TicketController@createNote')->name('tickets.create_note');

    Route::delete('/tickets/notes/{note}','TicketController@deleteNote')->name('tickets.delete_note');

    Route::put('/tickets/{ticket}/category','TicketController@updateCategory')->name('tickets.update_category');

    Route::put('/tickets/{ticket}/update_column/{column}','TicketController@updateColumn')->name('tickets.update_column');

    Route::put('/tickets/{ticket}/update_agents','TicketController@updateAgents')->name('tickets.update_agents');
});