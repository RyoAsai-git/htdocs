<?php 
//タイプヒンティング
//型を明示できる

// declare(strict_types=1);
//強い型指定
//これを使うと動かない
//phpは動的型付け言語 制限が弱い
//大規模開発などで利用されるケースある

ini_set("display_errors", 1);
error_reporting(E_ALL);

echo 'タイプヒンティングテスト' . '<br>';
/** 
 * @param $string
 */

function noTypeHint($string) {
    var_dump($string);
}

noTypeHint(['テスト']); //引数string予定に 配列 エラーはでない
//配列を引数で渡しているが、型の指定がないため出力される
//array(1) { [0]=> string(9) "テスト" }
echo '<br>';

//タイプヒンティング (引数に型を指定 型が違うとエラー)

function TypeTest(string $string) { //引数stringの他に、array, callable, bool, float, int, object, クラス名, インターフェース名 
    //引数$stringの前に引数の型stringを指定
    var_dump($string);
}

TypeTest(['配列文字']);
//引数にstringと指定しているのに配列 こちらはエラー
//Fatal error: Uncaught TypeError