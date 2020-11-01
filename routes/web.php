<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/peternak', 'PeternakController@index')->name('peternak.index');
Route::get('/distributor', 'DistributorController@index')->name('distributor.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
