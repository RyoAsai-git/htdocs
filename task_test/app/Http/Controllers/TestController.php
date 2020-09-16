<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;
//作成したModelsファイルのTestを持ってくることができる

use Illuminate\Support\Facades\DB;
//クエリビルダを使うための記述
//DBファサードをインポート

class TestController extends Controller
{
    //
    public function index() {

        $values = Test::all();
        //変数$valueにモデル名のall


        // $tests = DB::table('tests')->get();
        //DBコロン staticなメソッド
        //table testsへアクセス

        $tests = DB::table('tests')
        ->select('id')
        ->get();
        //このようにメソッドチェーンで書くこともできる
        //SQLで条件指定したのをより簡単に書くことができる
        // ex
        // ->select()
        // ->where()
        // ->groupBy()
        // ->get();

        //rawメソッドを使えば生のSQLを記述できる
        // ex
        // selectRaw('SQL文')

        dd($tests);
        //eloquentと取るのに比べて中身が少ない？
        //画面上で表示される最低限の情報?

        // Illuminate\Support\Collection {#366 ▼
        //     #items: array:2 [▼
        //       0 => {#1262 ▼
        //         +"id": 1
        //         +"text": "aaa"
        //         +"created_at": "2020-09-15 16:54:33"
        //         +"updated_at": "2020-09-15 16:54:33"
        //       }
        //       1 => {#1263 ▼
        //         +"id": 2
        //         +"text": "bbb"
        //         +"created_at": "2020-09-15 16:58:47"
        //         +"updated_at": "2020-09-15 16:58:47"
        //       }
        //     ]
        //   }

        // select('id')->get();
        // Illuminate\Support\Collection {#366 ▼
        //     #items: array:2 [▼
        //       0 => {#1262 ▼
        //         +"id": 1
        //       }
        //       1 => {#1263 ▼
        //         +"id": 2
        //       }
        //     ]
        //   }

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
