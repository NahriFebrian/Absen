<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/absen', 'HomeController@absen');
Route::post('/absen/create', 'HomeController@create');
Route::post('/absen/store', 'HomeController@store');
Route::get('/absen/{id}/edit', 'HomeController@edit');
Route::post('/absen/{id}/update', 'HomeController@update');
Route::get('/absen/{id}/delete', 'HomeController@delete');