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

// Route::get('contact/index', 'ContactFormController@index');
// contact/indexにアクセスしたら, ContactFormControllerのindexメソッドが実行される

Route::get('shops/index', 'ShopController@index');

Route::group(['prefix' => 'contact', 'middleware' => 'auth'], function(){
    //prefixでフォルダ名は指定済み
    //'contact.index'と書かなくて良い
    Route::get('index', 'ContactFormController@index')->name('contact.index');
    Route::get('create', 'ContactFormController@create')->name('contact.create');
    Route::post('store', 'ContactFormController@store')->name('contact.store');
    Route::get('show/{id}', 'ContactFormController@show')->name('contact.show');
    Route::get('edit/{id}', 'ContactFormController@edit')->name('contact.edit');
    //editは'{id}/edit'でも可能
    Route::post('update/{id}', 'ContactFormController@update')->name('contact.update');
    Route::post('destroy/{id}', 'ContactFormController@destroy')->name('contact.destroy');
    //アクション名はdeleteでも良いが、コントローラーでdestroyで作成しているため、今回はdestroyで作成
    
});
//'prefix' => 'フォルダ名' フォルダ指定
//'middleware' => 'auth' 認証されていたら表示


// REST
// Route::resource('contacts', 'ContactFormController');

Auth::routes();
//ユーザー認証関連

Route::get('/home', 'HomeController@index')->name('home');
