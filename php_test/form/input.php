<?php

//スーパーグローバル変数 php 9種類
//連想配列
//nameがキー
//valueがvalue

echo '<pre>';
var_dump($_GET);
/*
array(2) {
  ["name"]=>
  string(9) "いいい"
  ["sports"]=>
  array(3) {
    [0]=>
    string(6) "野球"
    [1]=>
    string(12) "サッカー"
    [2]=>
    string(9) "バスケ"
  }
}
*/

var_dump($_GET['sports']);
/*
array(3) {
  [0]=>
  string(6) "野球"
  [1]=>
  string(12) "サッカー"
  [2]=>
  string(9) "バスケ"
}

*/

//入力確認フォーム
//入力 確認 完了 input.php confirm.php thanks.php 分けるのが一般的

//今回はif文でinput.php内で作成

$pageFlag = 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <?php if ($pageFlag === 0) : ?>
    <!-- 入力 -->

  <?php endif ?>

  <?php if ($pageFlag === 1) : ?>
    <!-- 確認 -->
  <?php endif ?>

  <?php if ($pageFlag === 2) : ?>
    <!-- 完了 -->
  <?php endif ?>
  <form action="input.php" method="GET">
    名前
    <input type="text" name="name">

    <input type="email" name="email">
    <input type="checkbox" name="sports[]" value="野球">野球
    <input type="checkbox" name="sports[]" value="サッカー">サッカー
    <input type="checkbox" name="sports[]" value="バスケ">バスケ
    <input type="submit" value="送信">
  </form>
</body>
</html>