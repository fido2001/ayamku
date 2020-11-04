<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('kecamatan', 'KecamatanController');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Admin');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Admin');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Admin');
});

Route::prefix('peternak')->middleware('auth')->group(function () {
    Route::get('/', 'PeternakController@index')->name('peternak.index');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Peternak');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Peternak');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Peternak');
});

Route::prefix('distributor')->middleware('auth')->group(function () {
    Route::get('/', 'DistributorController@index')->name('distributor.index');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Distributor');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Distributor');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Distributor');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
