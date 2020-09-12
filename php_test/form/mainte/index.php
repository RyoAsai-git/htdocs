<?php
require('db_connection.php');

//データベース表示
//方法は大きく2種類
//ユーザー入力なし query
//毎回決まったSQL文
// $sql = 'SELECT * FROM contacts WHERE id = 3'; //sql
// $stmt = $pdo->query($sql); //sql実行 $stmt ステートメント

// $result = $stmt->fetchall(); //sqlの結果をfetchallで表示 $resultへ代入

// echo '<pre>';
// var_dump($result); 
// echo '<pre>';



//ユーザー入力あり prepare, bind, execute  <- SQLインジェクション対策のためにこの三つを使う 
//悪意のあるユーザーにお問い合わせにdelete文などを打ってくる データベースが不正に操作される SQLインジェクション
//検索画面 お問い合わせフォームなどユーザーが入力する場合

$sql = 'SELECT * FROM contacts WHERE id = :id'; //sql idがユーザー入力によって変わるので?か:idを入力 これをプレースホルダと呼ぶ
// $sql = 'SELECT * FROM contacts WHERE id = :id'; //sql //:id 名前付きプレースホルダ

$stmt = $pdo->prepare($sql); //preparedステートメント

$stmt->bindValue('id', 2, PDO::PARAM_INT); //紐付け
//1 名前
//2 実際に入力したい値
//3 型

$stmt->execute(); //実行

$result = $stmt->fetchAll();

echo '<pre>';
var_dump($result);
echo '<pre>';

