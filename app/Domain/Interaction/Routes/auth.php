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

    Route::get('/announcements','AnnouncementController@index')->name('announcements.index');

    Route::post('/announcements', 'AnnouncementController@storeOrUpdate')->name('announcements.store');

    Route::get('/announcements/create', 'AnnouncementController@createOrEdit')->name('announcements.create');
    
    Route::get('/announcements/{announcement}','AnnouncementController@show')->name('announcements.show');
    
    Route::get('/announcements/{announcement}/edit','AnnouncementController@createOrEdit')->name('announcements.edit');

    Route::put('/announcements/{announcement}','AnnouncementController@storeOrUpdate')->name('announcements.update');
    
    Route::delete('/announcements/{announcement}','AnnouncementController@destroy')->name('announcements.destroy');



    Route::get('/contacts','ContactController@index')->name('contacts.index');

    Route::post('/contacts', 'ContactController@storeOrUpdate')->name('contacts.store');

    Route::get('/contacts/create', 'ContactController@createOrEdit')->name('contacts.create');
    
    Route::get('/contacts/{contact}','ContactController@show')->name('contacts.show');
    
    Route::get('/contacts/{contact}/edit','ContactController@createOrEdit')->name('contacts.edit');

    Route::put('/contacts/{contact}','ContactController@storeOrUpdate')->name('contacts.update');
    
    Route::delete('/contacts/{contact}','ContactController@destroy')->name('contacts.destroy');


    
    Route::get('/mails','MailController@index')->name('mails.index');

    Route::post('/mails', 'MailController@storeOrUpdate')->name('mails.store');

    Route::get('/mails/create', 'MailController@createOrEdit')->name('mails.create');
    
    Route::get('/mails/{mail}','MailController@show')->name('mails.show');
    
    Route::get('/mails/{mail}/edit','MailController@createOrEdit')->name('mails.edit');

    Route::put('/mails/{mail}','MailController@storeOrUpdate')->name('mails.update');
    
    Route::delete('/mails/{mail}','MailController@destroy')->name('mails.destroy');


    
    Route::get('/mail_templates','MailTemplateController@index')->name('mail_templates.index');

    Route::post('/mail_templates', 'MailTemplateController@storeOrUpdate')->name('mail_templates.store');

    Route::get('/mail_templates/create', 'MailTemplateController@createOrEdit')->name('mail_templates.create');
    
    Route::get('/mail_templates/{mail_template}','MailTemplateController@show')->name('mail_templates.show');
    
    Route::get('/mail_templates/{mail_template}/edit','MailTemplateController@createOrEdit')->name('mail_templates.edit');

    Route::put('/mail_templates/{mail_template}','MailTemplateController@storeOrUpdate')->name('mail_templates.update');
    
    Route::delete('/mail_templates/{mail_template}','MailTemplateController@destroy')->name('mail_templates.destroy');
});