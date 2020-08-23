<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
    変数の値です<?php print($value) ?>
    <!-- 変数の値が表示されていない -->
    <!-- 変数の値はページ移動時に消えている 表示している画面のみ使える　ログインidの情報などは次回も使えるようにcookieに保存する必要 -->
    <!-- デベロッパーツールからapplication storage cookie確認 -->
    <!-- パスワード、個人情報保存危険 -->
    <!-- 攻撃により盗まれる可能性ある setcookieには沢山のパラメータ存在 パス指定　ドメインで絞るなど -->
    <!-- setcookieのリファレンス参照 -->
  <?php print($_COOKIE['save_message']);
  //$_COOKIEにcookieを保存するグローバル変数
  
  ?>
</pre>
</main>
</body>    
</html>