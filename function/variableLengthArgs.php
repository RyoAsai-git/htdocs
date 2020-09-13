<?php

//可変変数

function combine(string ...$name): string {
    //関数の引数に...をつけて引数を書く
    //複数の変数をまとめて指定できる
    //引数を三つ渡したい時 テスト１テスト２など これまでは引数を三つ書かないと行けなかったが...で済む
    //php7から : stringで戻り値の型を指定することができる : arrayなら配列で戻り値の型指定 
    $combineName = '';
    for ($i = 0; $i < count($name); $i++) {
        //$nameは配列になっている
        // array(2) { [0]=> string(6) "苗字" [1]=> string(6) "名前" } 
        $combineName .= $name[$i];
        if ($i != count($name) - 1) {
            // 次に続く要素があれば・をつける条件分岐
            // $i = 0であればcount($name) - 1はイコールではないので次に続く要素があると判断される
            // $i = 2であれば count($name) - 1はイコールとなり、次に続く要素がない
            $combineName .= '・';
        }
    }
    return $combineName;
}

$lName = '名前';
$fName = '苗字';
$name1 = combine($fName, $lName);

echo '結合結果' . $name1;
echo '<br>';

$variableLength = combine('テスト１', 'テスト２', 'テスト３');
echo $variableLength;