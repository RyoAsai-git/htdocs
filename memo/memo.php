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
<!-- <pre> -->
  <?php 
    require('dbconnect.php');
    //他のファイルを取り込むことができる JavaScriptやHTMLも取り込める
    //パスがたまたま同じ階層にあるのでファイル名だけで取り込めている
    //ディレクトリ名や../などの使って読み込む
    //保守性が向上する
    
  // try {
  //   $db = new PDO('mysql:dbname=mydb;host=localhost;port=8889;charset=UTF8', 'root', 'root');
  //   //上の記述は他のファイルでも記述されており、接続するdbが変わった時に保守性が悪い
  //   //別のファイルを作成し共通化
  // } catch (PDOException $e) {
  //   echo 'DB接続エラー：' . $e->getMessage(); 
  // }

  // $_REQUEST['id']
  //URLパラメータを使う
  //WHERE以降にURLパラメータをいれる
  //今回は$_REQUEST 何かのタイミングでPOSTを使う可能性があるため
  //このままWHERE以降に記述するのは危険
  //URLパラメータを使う場合はprepareメソッド

  // $memos = $db->query('SELECT * FROM memos WHERE id=1');

  $id = $_REQUEST['id'];
   //$memos->execute(array($_REQUEST['id']));から$_REQUEST['id']を$id に格納
  if (!is_numeric($id) || $id <= 0) {
    print('1以上の数字で指定してください');
    exit;
  }

  $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
  $memos->execute(array($id));
  $memo  = $memos->fetch();
  //ここではwhileを使わない
  //SQLの時点で一件のメモに絞り込んでいるので返ってくるメモも一件

  //$memos executeで取得したレコードセットから一件fetchをし,$memoへ

  //prepareで安全性は上がったが
  //URLパラメータはユーザーが自由に書き換えできてしまう
  //データベースでは安全性が確保できているが,何もない画面が表示できてしまうことからあまり良いコードとは言えない

  ?>
<!-- </pre> -->
  <article>
    <pre><?php print($memo['memo']) ?></pre>
    <a href="update.php?id=<?php print($memo['id']) ?>">編集する</a>
    |
    <a href="index.php">戻る</a>
  </article>
</main>
</body>    
</html>