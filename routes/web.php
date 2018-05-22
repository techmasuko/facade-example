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

// /のようなURI x Requestメソッドの組み合わせ 毎に何を行うか判断する
// GET/POSTいずれかのリクエストがブラウザから送信される
// POST を POST/PUT/DELETE
// PUT/DELETE
// C=POST R=GET U=PUT D=DELETE
Route::get('/', function () {
    // response
    // resorces/views から見たファイル名を指定する
    // その際に .blade.phpのファイルを参照します
    // view関数の引数には .blade.phpの拡張子は指定しなくて良い
    // ディレクトリの下にファイルを表示したい場合は . で区切る
    return view('folder.hogehoge', ['test' => 'testと表示されるか']);
});
