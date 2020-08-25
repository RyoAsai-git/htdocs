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
        $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 
        'root', 'root');
        //$dbはオブジェクト PDOのインスタンス
        //$dbのインスタンスが様々なメソッドやプロパティを持っている

        $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');
        //memoの部分の$_POST['memo']はinput.html内のmethodがpostのため
        //postで渡ってきたものにindex.phpのname属性で一致するmemoを指定
        //NOW SQLで利用できる関数 今の時刻をいれる SQLはこのような簡単なプログラムを書くことができる
    } catch (PDOException $e) {
        echo 'DB接続エラー：' . $e->getMessage();
    }

?>
</pre>
</main>
</body>    
</html>