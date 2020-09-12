<?php
// //パスワードを記録したファイルの場所
// echo __FILE__;
// // /Applications/MAMP/htdocs/php_test/form/mainte/test.php

//ファイル名の先頭に.をつけることで隠しファイルとなる

// //パスワード(暗号化)
// //crypt
// //password_hash

// echo '<br>';
// echo (password_hash('password123', PASSWORD_BCRYPT));
// //1 パスワード
// //2 パスワードの暗号化の種類


//ファイル丸ごと読み込む
$contactFile = '.contact.dat';

// $fileContents = file_get_contents($contactFile);
//ファイルの内容を全て文字列に読み込む

// echo $fileContents;

// //ファイルに書き込み(上書き)
// file_put_contents($contactFile, 'テストです');
// //全ての文字を消して上書きした形になる

// $addText = 'テストです' . "\n";
//改行して文字列を追記する

//ファイルに書き込み(追記)
// file_put_contents($contactFile, 'テストです', FILE_APPEND);

// file_put_contents($contactFile, $addText, FILE_APPEND);


//csvファイルの表示
//配列 file foreach 
//区切る explode

// $allData = file($contactFile);

// foreach ($allData as $lineData) {
//     $lines = explode(',', $lineData);
//     //explodeでコンマごと切り取る
//     //explodeの返り値も配列になっている
//     echo $lines[0] . '<br>';
//     echo $lines[1] . '<br>';
//     echo $lines[2] . '<br>';
// }


//ストリーム型
$contents = fopen($contactFile, 'a+');
//2 アクセス形式を指定
//今回は読み込み書き出し形式でオープン

$addText = '1行追記' . "\n";

fwrite($contents, $addText);
//書き込む

fclose($contents);
//ファイルを閉じる