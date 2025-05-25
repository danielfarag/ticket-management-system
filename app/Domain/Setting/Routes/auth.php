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

    
    Route::get('/block_ips','BlockIpController@index')->name('block_ips.index');

    Route::post('/block_ips', 'BlockIpController@storeOrUpdate')->name('block_ips.store');

    Route::get('/block_ips/create', 'BlockIpController@createOrEdit')->name('block_ips.create');
    
    Route::get('/block_ips/{block_ip}','BlockIpController@show')->name('block_ips.show');
    
    Route::get('/block_ips/{block_ip}/edit','BlockIpController@createOrEdit')->name('block_ips.edit');

    Route::put('/block_ips/{block_ip}','BlockIpController@storeOrUpdate')->name('block_ips.update');
    
    Route::delete('/block_ips/{block_ip}','BlockIpController@destroy')->name('block_ips.destroy');



    Route::get('/quick_links','QuickLinkController@index')->name('quick_links.index');

    Route::post('/quick_links', 'QuickLinkController@storeOrUpdate')->name('quick_links.store');

    Route::get('/quick_links/create', 'QuickLinkController@createOrEdit')->name('quick_links.create');
    
    Route::get('/quick_links/{quick_link}','QuickLinkController@show')->name('quick_links.show');
    
    Route::get('/quick_links/{quick_link}/edit','QuickLinkController@createOrEdit')->name('quick_links.edit');

    Route::put('/quick_links/{quick_link}','QuickLinkController@storeOrUpdate')->name('quick_links.update');
    
    Route::delete('/quick_links/{quick_link}','QuickLinkController@destroy')->name('quick_links.destroy');


    Route::get('/settings','SettingController@index')->name('settings.index');

    Route::post('/settings', 'SettingController@storeOrUpdate')->name('settings.store');


    Route::get('/members','MemberController@index')->name('members.index');

    Route::post('/members', 'MemberController@storeOrUpdate')->name('members.store');

    Route::get('/members/create', 'MemberController@createOrEdit')->name('members.create');
    
    Route::get('/members/{member}','MemberController@show')->name('members.show');
    
    Route::get('/members/{member}/edit','MemberController@createOrEdit')->name('members.edit');

    Route::put('/members/{member}','MemberController@storeOrUpdate')->name('members.update');
    
    Route::delete('/members/{member}','MemberController@destroy')->name('members.destroy');
});
