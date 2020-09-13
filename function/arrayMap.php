<?php
$parameters = [' 空白あり ', ' 配列 ', ' 空白あり '];

echo '<pre>';
var_dump($parameters);
echo '</pre>';

//array_map(引数に関数) 配列の値それぞれに関数を適用する
$trimedParameters = array_map('trim', $parameters);
//array_mapは引数にコールバック関数を入れることができる
// trimという関数で空白を削除
// 配列それぞれにtrimをかけたいときに使われる

echo '<pre>';
var_dump($trimedParameters);
echo '</pre>';


/*
array(3) {
  [0]=>
  string(14) " 空白あり "
  [1]=>
  string(8) " 配列 "
  [2]=>
  string(14) " 空白あり "
}
array(3) {
  [0]=>
  string(12) "空白あり"
  [1]=>
  string(6) "配列"
  [2]=>
  string(12) "空白あり"
}