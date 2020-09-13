<?php

function useCombine(array $name, callable $func) {
    $concatName = $func(...$name);
    print('無名関数での結合結果:'. $concatName . '<br>');
    //無名関数での結合結果:苗字 名前
}

$nameParam = ['名前', '苗字'];

//引数に名前のない関数(無名関数(クロージャ))
useCombine($nameParam, function(string $firstName, string $lastName) {
    return $lastName . " " . $firstName; 
    //ここでのfunctionはcallableの$funcで呼び出されている?
}
);