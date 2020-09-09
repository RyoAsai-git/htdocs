<?php
/*
require();
require_once();
エラーで処理が止まる
どちらかというとこちら

include();
include_once();
警告 処理は続く

namespace Laravel
*/

require('common.php');

echo $commonVariable;
//common.phpの変数

commonTest();
//common.phpの関数

//マジック定数
// __DIR__ ディレクトリ
// __FILE__ ファイル

echo __DIR__;
/*
/Applications/MAMP/htdocs/php_test
絶対パスを表示
*/

// require __DIR__ . 'common.php'; この形でもファイルを読み込むことができる

echo __FILE__;
/*
/Applications/MAMP/htdocs/php_test/sample7.php
現在のファイルのありかを表示
