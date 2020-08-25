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
  // try {
  //   $db = new PDO('mysql:dbname=mydb;host=localhost;port=8889;charset=UTF8', 'root', 'root');
  //   //上の記述は他のファイルでも記述されており、接続するdbが変わった時に保守性が悪い
  //   //別のファイルを作成し共通化


  //   //127.0.0.1は自分自身を指すipアドレス
  //   //MAMPで動いているapacheとMySQLが同じコンピューターのものだから
  //   //データベースのサーバーとwebサーバーが分かれていたらipアドレスは変わる
  //   //1つ目のroot ユーザー名
  //   //2     root パスワード　MAMPの場合はroot

  //   // new PDOとしてオブジェクトのインスタンス作成
  //   // PDO pha data object データベースを扱うためのオブジェクト
  //   //コンストラクターを作るために
  //   //1つ目のパラメーター 接続文字列 データベースに接続するための文字列 データベースの種類によって異なる
  //   // mysqlの場合はmysql: データベース名 ホスト(サーバーのアドレス) 文字コード(charset)
  //   //2                ユーザー名
  //   //3                 パスワード
  //   //tryの記述がないと ユーザー名を間違えた際にfatal errorというプログラムの動作を止める一番強いエラーが起きる
  //   //この後ユーザーが使う場合に困惑してしまう
  //   //データベースがうまく動作していない データベースのサーバーが落ちている場合にもfatal error
  //   //tryを使うことでfatal errorを防ぐ 例外処理
  //   //try catch
  // } catch (PDOException $e) {
  //   echo 'DB接続エラー：' . $e->getMessage(); 
  //   //PDOException という種類のメッセージを渡して例外処理を発生させてくれる
  //   //tryのなかにPDOを作成し、接続がうまくいかなかった際に例外を投げてくれる
  //   //PDOExceptionを$eという形で受け取って $eの中のメッセージを画面に出力するという動き
  //   //これによりデータベースにうまく接続できなかった場合などにエラー画面に移動させる
  //   //データベースを使わなくてもできる処理を行う
  //   //プログラマーがどんな動作をするか制御できる
  //   //例外処理はデータベース以外にも使用する
  // }

  require('dbconnect.php');

  // $count = $db->exec('INSERT INTO my_items SET maker_id = 1, item_name = "もも", price = 210, keyword="缶詰, ピンク, 甘い"');
  // //execにはSQLを直接書く
  // //注意 execのメソッドのパラメーターとして指定したクオテーション記号とSQLの中で使用したクオーテーションは分けるかescape
  // //パラメーターはシングル SQLはダブルが一般的
  // //実際にデータベースに影響を与えた行の数が戻り値で帰ってくる $countで受け取る
  // //$dbはnew PDOのインスタンスとして準備したもの
  // //ここではlocalhostのmydbへのアクセス情報を持っているため$mydbのテーブルは$dbを用いて自由に操作できる

  // //update構文など複数行に影響あるSQLを使うと$countにはその影響を与えた行数が入る
  // echo $count . '件のデータを挿入しました';

  // //execというメソッドは検索した結果を受け取ることができない
  //SELECT構文が使えない

  // $records = $db->query('SELECT * FROM my_items');
  // while ($record = $records->fetch()) {
  //   print($record['item_name'] . "\n");
  // }

  //queryメソッド パラメーターにSQLを取る点はexecと同じ
  //戻り値の内容が変わる
  //execは影響を与えた行の数
  //queryは得られた値 SELECT構文を使うときは必ずquery
  //$recordsはオブジェクトのインスタンスとなり、$recordセットのオブジェクトのインスタンスとなる
  //fetch
  //データベースから受け取ったrecordの行の集まりのうち、1行を取り出す
  //行を次々と取り出し、行が無くなったらfalseを返す これをwhile文に入れている falseになるとwhileは止まる
  //$recordは連想配列 $record['カラム名']で商品を取り出す

  $memos = $db->query('SELECT * FROM memos ORDER BY id DESC');
  ?>
<!-- </pre> -->
  <article>
    <?php while ($memo = $memos->fetch()) : ?>
        <p><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 50)) ?></a></p>
        <!-- mb_substrは３つのパラメータを取る -->
        <!-- 1 元となる文字列 -->
        <!-- 2 開始位置 -->
        <!-- 3 文字数-->
        <!-- href HyperText Reference どこにリンクを貼るのか指定する属性 -->


        <time><?php print($memo['created_at']) ?></time>
        <hr>
    <?php endwhile ?>
  </article>
</main>
</body>    
</html>