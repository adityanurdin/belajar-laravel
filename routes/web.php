<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * 
 * Route Auth
 * 
 */
Route::group(['middleware' => 'guest'], function() {
    Route::get('login', 'Auth\AuthController@loginView')->name('login');
    Route::post('login', 'Auth\AuthController@login')->name('login');
    
    Route::get('register', 'Auth\AuthController@registerView')->name('register');
    Route::post('register', 'Auth\AuthController@register')->name('register');
});


Route::group(['middleware' => 'auth'], function() {
    
    /**
     * 
     * Route Dashboard
     * 
     */
    Route::resource('dashboard', 'DashboardController')->middleware('auth');

    // USERS
    Route::get('users/data', 'UserController@data')->name('users.data');
    Route::get('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::resource('users', 'UserController')->except(['destroy']);
    
    // Gudang
    Route::get('gudang/data','GudangController@data')->name('gudang.data');
    Route::get('gudang/{slug}/delete','GudangController@destroy')->name('gudang.destroy');
    Route::resource('gudang', 'GudangController')->except(['destroy']);
    
    Route::get('logout', 'Auth\AuthController@logout')->name('logout');
});
