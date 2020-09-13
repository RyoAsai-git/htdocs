<?php
 
namespace App\Controllers;
 
// モデル読込、ファイル名でありクラス名でもある
use App\Models\TestModel;
//traitの時のuseと同じ
//TestModelクラスを持ってくる
//TestModelはファイル名であり、クラス名でもある

// ここもクラス名はファイル名と同じにするルール
class TestController
{
    public function run(){
        $model = new TestModel;
        //TestModelをuseでimportしてきているのでここでインスタンス化ができる
        echo $model->getHello();
        //TestModelないのメソッドを呼び出す
    }
}

//composerはライブラリを管理する機能もある