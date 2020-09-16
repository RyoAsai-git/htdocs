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
    // '/'アドレス ここにアクセスしたら処理を渡す
    // 処理とはここでのreturn view('welcome');
    return view('welcome');
    // viewファイルを表示しろという指令
    // viewファイルはresourcesのwelcome.blade.php
});
//このままだとコントローラーを経由せずそのままビューファイルに飛んでしまう

Route::get('tests/test', 'TestController@index');
//tests/testにアクセスしたらここに処理を飛ばすという指示  
// http://127.0.0.1:8000/tests/testでアクセスできる 
//TestControllerのメソッド名を指定

//要はtests/testにアクセスしたらTestControllerに飛ばしてという処理

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
