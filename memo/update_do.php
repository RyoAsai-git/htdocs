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
    require('dbconnect.php');
  
    $statement = $db->prepare('UPDATE memos SET memo=? WHERE id=?');
    //memo=? id=?という2つのパラメーターを渡す
    //1つ目 変更する内容
    //2つ目 どのメモを変更するのかというidの情報
    //どちらもformで渡ってきている
    //executeメソッドで渡してあげれば良い
    $statement->execute(array($_POST['memo'], $_POST['id']));
?>
<p>メモの内容を変更しました</p>
</pre>
  <a href="index.php">戻る</a>
</main>
</body>    
</html>