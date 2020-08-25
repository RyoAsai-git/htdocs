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

    // new PDOとしてオブジェクトのインスタンス作成
    // PDO pha data object データベースを扱うためのオブジェクト
    //コンストラクターを作るために
    //1つ目のパラメーター 接続文字列 データベースに接続するための文字列 データベースの種類によって異なる
    // mysqlの場合はmysql: データベース名 ホスト(サーバーのアドレス) 文字コード(charset)
    //2                ユーザー名
    //3                 パスワード
    //tryの記述がないと ユーザー名を間違えた際にfatal errorというプログラムの動作を止める一番強いエラーが起きる
    //この後ユーザーが使う場合に困惑してしまう
    //データベースがうまく動作していない データベースのサーバーが落ちている場合にもfatal error
    //tryを使うことでfatal errorを防ぐ 例外処理
    //try catch
  } catch (PDOException $e) {
    echo 'DB接続エラー：' . $e->getMessage(); 
    //PDOException という種類のメッセージを渡して例外処理を発生させてくれる
    //tryのなかにPDOを作成し、接続がうまくいかなかった際に例外を投げてくれる
    //PDOExceptionを$eという形で受け取って $eの中のメッセージを画面に出力するという動き
    //これによりデータベースにうまく接続できなかった場合などにエラー画面に移動させる
    //データベースを使わなくてもできる処理を行う
    //プログラマーがどんな動作をするか制御できる
    //例外処理はデータベース以外にも使用する
  }
  ?>
</pre>
</main>
</body>    
</html>