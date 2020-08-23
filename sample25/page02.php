<?php session_start(); ?>
<!-- これを書かないとphpだとsession使えない -->
<!-- phpの設定 php.ini session auto start=0から１にするとこの記述が必要なくなる セッションが自動でスタートすることになる-->
<!-- webサイトで常時セッションを使う場合は有効 ただし実装すると全体的に負荷が上がるため　できればセッションを使うところでsession_startを使って明示的にセッションをスタートさせるのが良い-->
<!-- セッションはwebサーバーに値が保存される cookieと異なる cookieと異なりやや安全性高い-->
<!-- サーバーに保存したidはどのブラウザかをセッションidで区別　ブラウザはセッションidをcookieに保存 -->
<!-- セッションハイジャック パスワードなどをセッションに保存する場合は注意 興味があればセキュリティへ -->

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
  <?php print($_SESSION['session_message']); ?>
  <!-- セッションの場合はcookieと違ってブラウザを閉じると内容が消える -->
  <!-- ページ間を移動していても消えない ブラウザが閉じるまで情報が残る-->
  <!-- 変数はその画面で終わる -->
  <!-- cookieはブラウザを閉じても保存期間内であれば残る -->
</pre>
</main>
</body>    
</html>