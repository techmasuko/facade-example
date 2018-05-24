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

// messages/{id}
// messages/1
// $id = 1
// Message::find(1)
// Route::get('/', function() {});
// app/Http/Controllers
Route::get('/', 'MessagesController@index');

Route::resource('messages', 'MessagesController');