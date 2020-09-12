<?php

//php.ini 設定ファイル
//データベースに値が保存されない時のエラー表示
ini_set("display_errors", 1);
//エラーを表示する記述
//1を0にするとエラーが表示されない

error_reporting(E_ALL);
//error_reportingではエラーの出力レベルを設定できる
// E_PARSE – 構文エラー（実行前にチェックされる）
// E_ERROR – 実行時の致命的エラー
// E_WARNING – 実行時の警告（重要）
// E_NOTICE – 実行時の警告
// E_DEPRECATED – 廃止予定の文法、関数が使用されている (PHP 5.3)
// E_STRICT – 非推奨な記述がある（コンパイル時に発生するものもあり）

// E_ALLを設定すると基本的に全てのエラーチェックが行われる
// ただし、E_STRICTだけはE_ALLに含まれていない
// E_STRICTレベルの警告を表示する場合は E_ALL || E_STRICTと指定する

// db接続 pdo
require 'db_connection.php';

// 入力 db保存 prepare, bind, execute(配列) //formで送信されてくる値が全て文字列なため配列で管理
$params = [
    'id'         => null, //オートインクリメント指定のため自動的に値が入る ここであえてidを指定する必要がない
    'your_name'  => '名前',
    'email'      => 'test@test.com',
    'url'        => 'http://test.com',
    'gender'     => '1',
    'age'        => '2',
    'contact'    => 'いいい',
    'created_at' => null, //timestampでも自動的に値が入る ここでNOW()などと指定するとエラーになる
];

$count   = 0;
$columns = '';
$values  = '';

foreach (array_keys($params) as $key) {
    if ($count++>0) {
        $columns .= ',';
        $values  .= ',';
    }
    $columns .= $key;
    $values  .= ':'. $key;
}

$sql = 'INSERT INTO contacts ('. $columns . ')values('. $values .')'; //sql idがユーザー入力によって変わるので?か:idを入力 これをプレースホルダと呼ぶ
// $sql = 'SELECT * FROM contacts WHERE id = :id'; //sql //:id 名前付きプレースホルダ

// var_dump($sql);
// exit;

$stmt = $pdo->prepare($sql); //preparedステートメント

$stmt->execute($params); 
