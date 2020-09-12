<?php

const DB_HOST = 'mysql:dbname=udemy_php;host=localhost;charset=utf8';
const DB_USER = 'php_user';
const DB_PASSWORD = 'password123';
// //const 定数化

// //例外処理 データベースに接続できずに処理が進んだらまずいため
try { 
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        //データベースの情報を取得するとき連想配列でとってくる
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //例外を表示
        PDO::ATTR_EMULATE_PREPARES => false,
        //SQLインジェクション対策
    ]);
    //データベースへ接続
    //配列でオプションを設定
    echo '接続成功';
} catch (PDOException $e) {
    echo '接続失敗'. $e->getMessage() . "\n";
    exit;
}
