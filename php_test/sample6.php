<?php 
//スコープ

$globalVariable = 'グローバル変数です';

function checkScope($str) {
    $localVariable = "ローカル変数です";
    // echo $localVariable;

    // echo $globalVariable;
    //表示されない
    //スコープ
    echo $str;
}

// echo $globalVariable;
// echo $localVariable;

//このままではスコープの範囲で$localVariableは出力されない
// checkScope();
//

checkScope($globalVariable);

//変数をスコープの範囲外で使いたい場合は関数の引数で渡してあげると良い