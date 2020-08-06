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

Route::get('list', 'UserController@view');

Route::get('loadListAll', 'UserController@ajaxAll');

Route::post('add-user', 'UserController@create');

Route::post('edit-user', 'UserController@update');

Route::delete('delete-user', 'UserController@delete');
