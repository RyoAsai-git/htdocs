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
    date_default_timezone_set('Asia/Tokyo');
    print(date('G'));
    $close_time = 9;
    if (date('G') < $close_time) {
        print('現在受付時間外です');
    } else {
        print('ようこそ');
    }

    $x = 'ああああ';
    if ($x) { //数字文字あり true //なし　false
      print('文字あり');
    }

    $y = 1; //0はfalse それ以外true
    if ($y) {
        print('xは0以外です');
    }
?>
</pre>
</main>
</body>    
</html>