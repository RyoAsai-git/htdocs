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
  $age = '２０';
  
  $age = mb_convert_kana($age, 'n', 'UTF-8');
  //n 半角
  //半角のカナ　全角
  //英数字を半角 全角
  //ユーザーから送信された値を統一するのに便利
  if (is_numeric($age)) {
    // 数字であるか判断 boolean
    // 全角数字はfalse
    print($age . '歳');
  } else {
    print('※ 年齢が数字ではありません');
  }
  ?>
</pre>
</main>
</body>    
</html>