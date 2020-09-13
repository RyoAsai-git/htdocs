<?php 

require_once __DIR__ . '/vendor/autoload.php';
//一度だけオートロードファイルを読み込む必要

use App\Controllers\TestController;

$app = new TestController;
$app->run();
//TestController内のファンクション
//TestModel内のgetHello();を出力する

use Carbon\Carbon;
//carbonのクラスを持ってくる

echo Carbon::now();

echo Carbon::now()->format(‘今日はY年m月d日だよ！’);