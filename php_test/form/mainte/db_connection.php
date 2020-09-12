<?php

const DB_HOST = 'mysql:dbname=udemy_php;host=localhost;charset=utf8';
const DB_USER = 'php_user';
const DB_PASSWORD = 'password123';
// //const 定数化


// //例外処理 データベースに接続できずに処理が進んだらまずいため
try { 
    $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
    //データベースへ接続
    echo '接続成功';
} catch (PDOException $e) {
    echo '接続失敗'. $e->getMessage() . "\n";
    exit;
}
