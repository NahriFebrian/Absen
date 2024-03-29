<?php

use Illuminate\Http\Request;

Route::post('auth/register','AuthController@register');
Route::post('auth/login','AuthController@login');
Route::get('users','UserController@users');
Route::get('users/profile','UserController@profile')->middleware('auth:api');
Route::get('users/{id}','UserController@profileById');
Route::get('absen/{id}','AbsenController@profileById');
Route::post('absen','AbsenController@add')->middleware('auth:api');
Route::put('absen/{absen}','AbsenController@update')->middleware('auth:api');
Route::delete('absen/{absen}','AbsenController@delete')->middleware('auth:api');
Route::get('status','StatusController@status');
Route::post('status','StatusController@add')->middleware('auth:api');
Route::put('status/{status}','StatusController@update')->middleware('auth:api');
Route::delete('status/{status}','StatusController@delete')->middleware('auth:api');