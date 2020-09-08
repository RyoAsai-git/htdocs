<?php 
//文字列の長さ

$text = 'abc';

echo strlen($text);
//3

$text2 = 'あいうえお';

echo strlen($text2);
//15 
//マルチバイト
/*
日本語 文字コードSJIS, UTF-8 
UTF-8は1文字3バイト使っている
*/

// マルチバイトのstring関数を使う
echo mb_strlen($text2);
//5 


//文字列の置換

$str = '文字列を置換します';

echo str_replace('置換', 'ちかん', $str);
//引数を3つとる
//1 置き換える文字
//2 置き換え先
//3 置き換える文字
//文字列をちかんします