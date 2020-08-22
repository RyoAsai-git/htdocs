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
  
  $news = file_get_contents('../news_data/news.text');
  // print($news); //変数化　内容に追記が可能
  $news .= '2020-08-22 ニュースを追加しました' . "\n";
  file_put_contents('../news_data/news.text', $news);
  // readfile('../news_data/news.text'); //読み込むだけ

  print($news);
?>
</pre>
</main>
</body>    
</html>