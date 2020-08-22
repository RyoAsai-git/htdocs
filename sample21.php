<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
<?php 
  $zip = '987-6543';
  //全角数字の場合は半角になる ハイフンを忘れるとエラー
  $zip = mb_convert_kana($zip, 'a', 'UTF-8');
  //a 英数字を半角 ハイフンがくる可能性からaを使う
  //以下正規表現 phpだけでなくJS rubyなどでも使う
  //preg_match １パラメータ 正規表現
  if (preg_match("/\A\d{3}[-]\d{4}\z/", $zip)) {
    ///\A　文章の頭である これがないとabcde123-4567という頭に違う数字がくるのを許可してしまう
    //\d{3} d　数字 3は三つ 数字が三回続くことというルール
    //[-]　次の数字をハイフンで結んでくださいというルール
    //d{4}　数字を四つ並べる
    //\z/　文章の最後を表す 

    //正規表現では会員番号　購入番号など
    //メアドなどは種類が多い　正規表現難しい php5からのブラウザ判定機能を用いることが多い
    print('郵便番号: 〒' . $zip);
  } else {
    print('※ 郵便番号を　123-4567の形式でご記入ください');
  }
?>
</pre>
</main>
</body>    
</html>