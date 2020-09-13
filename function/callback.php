<?php

function combineSpace(string $firstName, string $lastName): string {
    return $lastName . '' .  $firstName;
}

$nameParam = ['名前', '苗字'];

//コールバック関数
function useCombine(array $name, callable $func) {
    $concatName = $func(...$name);
    // var_dump($name);
    //array(2) { [0]=> string(6) "名前" [1]=> string(6) "苗字" }
    print($func . '関数の結合結果:' . $concatName . '<br>');
    //combineSpace関数の結合結果:苗字名前
}


useCombine($nameParam, 'combineSpace');
//combineSpaceという関数