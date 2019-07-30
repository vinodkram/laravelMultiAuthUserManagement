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

Route::group(['prefix' => 'client','middleware'=>'client'], function() {
      Route::get('/', 'ClientController@index')->name('client');
      Route::get('edit', 'ClientController@edit')->name('client.edit');
      Route::post('update', 'ClientController@update')->name('client.update');
});

Route::group(['prefix' => 'back-office','middleware'=>'backoffice'], function() {
      Route::get('/', 'BackOfficeController@index')->name('backoffice');
      Route::get('edit', 'BackOfficeController@edit')->name('backoffice.edit');
      Route::post('update', 'BackOfficeController@update')->name('backoffice.update');
      Route::get('clients', 'BackOfficeController@clients')->name('backoffice.clients');
      Route::get('clients-add', 'BackOfficeController@clientsAdd')->name('backoffice.clients.add');
      Route::post('clients-save', 'BackOfficeController@clientsSave')->name('backoffice.clients.save');
      Route::get('clients-edit/{id}', 'BackOfficeController@clientsEdit')->name('backoffice.clients.edit');
      Route::post('clients-update', 'BackOfficeController@clientsUpdate')->name('backoffice.clients.update');
      Route::get('clients-delete/{id}', 'BackOfficeController@clientsDelete')->name('backoffice.clients.delete');
});

Route::group(['prefix' => 'admin','middleware'=>'admin'], function() {
      Route::get('/', 'AdminController@index')->name('admin');
      Route::get('edit', 'AdminController@edit')->name('admin.edit');
      Route::post('update', 'AdminController@update')->name('admin.update');
      Route::get('users', 'AdminController@users')->name('admin.users');
      Route::get('user-add', 'AdminController@userAdd')->name('admin.user.add');
      Route::post('user-save', 'AdminController@userSave')->name('admin.user.save');
      Route::get('user-edit/{id}', 'AdminController@userEdit')->name('admin.user.edit');
      Route::post('user-update', 'AdminController@userUpdate')->name('admin.user.update');
      Route::get('user-delete/{id}', 'AdminController@userDelete')->name('admin.user.delete');
});
