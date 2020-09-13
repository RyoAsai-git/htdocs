<?php 

ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
//一度だけオートロードファイルを読み込む必要

use App\Controllers\TestController;

$app = new TestController;
$app->run();
//TestController内のファンクション
//TestModel内のgetHello();を出力する