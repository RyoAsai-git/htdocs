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

$result = $stmt->fetchall();

echo '<pre>';
var_dump($result);
echo '<pre>';

//トランザクション まとまって処理するときに必要な考え方
// ex 銀行 残高を確認->Aさんから引き落とし->Bさんに振り込む
// sqlだとAさんから金額を引いて Bさんに足す
// 仮にBさんに振り込む際に処理が止まってしまい、Aさんから引き落としているのに、Bさんに振り込まれていないケースが発生してしたとする
// これは非常にまずいので 残高を確認->Aさんから引き落とし->Bさんに振り込む の処理を一括りにする
// うまくいかなければ最初に戻る

// beginTransaction トランザクションの開始
// commit まとめて処理
// rollback うまくいかなければ最初に戻る

$pdo->beginTransaction();

try {
    //sql処理
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', 3, PDO::PARAM_INT);
    $stmt->execute();

    $pdo->commit();
} catch (PDOException $e) {
    $pdo->rollBack(); //更新のキャンセル
}