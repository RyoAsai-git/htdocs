<?php 
//スコープ

$globalVariable = 'グローバル変数です';

function checkScope() {
    $localVariable = "ローカル変数です";
    echo $localVariable;
}

echo $globalVariable;
echo $localVariable;

//このままではスコープの範囲で$localVariableは出力されない
// checkScope();
//
