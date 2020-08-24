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
  <?php 
  try {
    $db = new PDO('mysql:dbname=mydb2;host=localhost;port=8889;charset=UTF8', 
    'root', 'root');
    //127.0.0.1は自分自身を指すipアドレス
    //MAMPで動いているapacheとMySQLが同じコンピューターのものだから
    //データベースのサーバーとwebサーバーが分かれていたらipアドレスは変わる
    //1つ目のroot ユーザー名
    //2     root パスワード　MAMPの場合はroot
    
  } catch (PDOException $e) {
    echo 'DB接続エラー：' . $e->getMessage(); 
  }
  ?>
</pre>
</main>
</body>    
</html>