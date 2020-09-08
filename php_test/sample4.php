<?php

//配列に配列を追加

$array = ['りんご', 'みかん'];

array_push($array, 'ぶどう', 'なし');

echo '<pre>';
var_dump($array);
/*
array(4) {
  [0]=>
  string(9) "りんご"
  [1]=>
  string(9) "みかん"
  [2]=>
  string(9) "ぶどう"
  [3]=>
  string(6) "なし"
}
*/

