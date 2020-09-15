<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;
//作成したModelsファイルのTestを持ってくることができる

class TestController extends Controller
{
    //
    public function index() {

        $values = Test::all();
        //変数$valueにモデル名のall

        // dd($values);
        // ddコマンド
        // phpでいうdieとvar_dumpをセットにしたもの
        // 処理を止めて変数の中身を表示してくれる

        //このように変数の中身が表示される
        //collection型
    
        // Illuminate\Database\Eloquent\Collection {#1341 ▼
        //     #items: array:2 [▼
        //       0 => App\Models\Test {#1340 ▼
        //         #connection: "mysql"
        //         #table: "tests"
        //         #primaryKey: "id"
        //         #keyType: "int"
        //         +incrementing: true
        //         #with: []
        //         #withCount: []
        //         #perPage: 15
        //         +exists: true
        //         +wasRecentlyCreated: false
        //         #attributes: array:4 [▼
        //           "id" => 1
        //           "text" => "aaa"
        //           "created_at" => "2020-09-15 16:54:33"
        //           "updated_at" => "2020-09-15 16:54:33"
        //         ]
        //         #original: array:4 [▼
        //           "id" => 1
        //           "text" => "aaa"
        //           "created_at" => "2020-09-15 16:54:33"
        //           "updated_at" => "2020-09-15 16:54:33"
        //         ]
        //         #changes: []
        //         #casts: []
        //         #dates: []
        //         #dateFormat: null
        //         #appends: []
        //         #dispatchesEvents: []
        //         #observables: []
        //         #relations: []
        //         #touches: []
        //         +timestamps: true
        //         #hidden: []
        //         #visible: []
        //         #fillable: []
        //         #guarded: array:1 [▶]
        //       }
        //       1 => App\Models\Test {#1339 ▶}
        //     ]
        //   }

        // $valuesをviewに持っていく
        // compact関数を使う
        // 複数の変数も渡すことができる

        return view('tests.test', compact('values'));
            //文字の変数は''で囲む

        //先ほどのweb.php内の命令からここが実行される
        // return view('tests.test');
        //resources/views/tests/に飛ぶ 
        //test.blade.php
    }
}
