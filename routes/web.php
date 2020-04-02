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

Route::get('export', 'MyController@export')->name('export');
Route::view('/', 'welcome');
Route::view('/import', 'import');
Route::post('importdm', 'MyController@import')->name('import');
