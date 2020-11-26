<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('artikel', 'ArtikelController');
    Route::resource('kecamatan', 'KecamatanController');
    Route::resource('vitamin', 'VitaminController');
    Route::resource('kategori', 'KategoriController');
    Route::delete('artikel/{artikel:slug}', 'ArtikelController@destroy')->name('artikel.destroy.admin');
    Route::get('artikel/{artikel:slug}', 'ArtikelController@edit')->name('artikel.edit.admin');
    Route::patch('artikel/{artikel:slug}', 'ArtikelController@update')->name('artikel.update.admin');
    Route::get('/dataAkun', 'AdminController@dataAkun')->name('admin.akun');
});

Route::prefix('peternak')->middleware('auth')->group(function () {
    Route::get('/', 'PeternakController@index')->name('peternak.index');
    Route::get('artikel', 'ArtikelController@index')->name('artikel.index.peternak');
    Route::get('artikel/{artikel:slug}', 'ArtikelController@show')->name('artikel.show.peternak');
    Route::resource('kandang', 'KandangController');
    Route::resource('progress', 'ProgressController');
    Route::get('progress-detail/{progress}', 'ProgressDetailController@index')->name('progress-detail.index');
    Route::post('progress-detail/{progress}', 'ProgressDetailController@store')->name('progress-detail.store');
    Route::resource('panen', 'PanenController');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Peternak');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Peternak');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Peternak');
    Route::get('/editPassword', 'UserController@editPassword')->name('edit.password.Peternak');
    Route::patch('/editPassword', 'UserController@updatePassword')->name('edit.password.Peternak');
    Route::get('/produk', 'ProdukController@index')->name('produk.index.peternak');
    Route::post('/produk', 'ProdukController@store')->name('produk.store');
});

Route::prefix('distributor')->middleware('auth')->group(function () {
    Route::get('/', 'DistributorController@index')->name('distributor.index');
    Route::get('/myProfile', 'UserController@myProfile')->name('profile.Distributor');
    Route::get('/editProfile', 'UserController@editProfile')->name('edit.profile.Distributor');
    Route::patch('/editProfile', 'UserController@updateProfile')->name('edit.profile.Distributor');
    Route::get('/editPassword', 'UserController@editPassword')->name('edit.password.Distributor');
    Route::patch('/editPassword', 'UserController@updatePassword')->name('edit.password.Distributor');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
