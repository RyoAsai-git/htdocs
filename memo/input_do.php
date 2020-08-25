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

    // try {
    //     $db = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 
    //     'root', 'root');
    //     //$dbはオブジェクト PDOのインスタンス
    //     //$dbのインスタンスが様々なメソッドやプロパティを持っている

    //     // $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');
    //     //memoの部分の$_POST['memo']はinput.html内のmethodがpostのため
    //     //postで渡ってきたものにindex.phpのname属性で一致するmemoを指定
    //     //NOW SQLで利用できる関数 今の時刻をいれる SQLはこのような簡単なプログラムを書くことができる
    //     //このコードは危険
    //     //$_POSTの値がそのまま指定されている
    //     //SQLに渡す文字列はきちんと処理をするべき 危険な文字列や危険な記号が入っているとSQLが壊されデータが盗まれる可能性

    //     //prepareメソッドを使う
    //     $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
    //     $statement->execute(array($_POST['memo']));
    //     echo 'メッセージが登録されました';

    //     //prepare
    //     //SQL文のSET memo=?の部分にユーザーが入力した値が入ってくることを準備
    //     //$statementはオブジェクトになりexecuteメソッドが準備される
    //     //execute
    //     //パラメーターに実際に何が入るかの値を指定 ここでいう$_POST['memo']
    //     //prepareの作った?に指定した内容が入る //数字か文字かは自動的に判別される
    //     //execは完全に安全なSQL つまり固定されたSQLを入力するのには良いが、今回はPOSTの値などformから送信された値をデータベースにいれる場合には必ずprepareで安全性を高める
    //     //$statement->bindParam(1, $_POST['memo']);
    //     //一番目に$_POST['memo']を指定するというやり方もある
    //     //?は複数指定できる 長いSQLの際

    // } catch (PDOException $e) {
    //     echo 'DB接続エラー：' . $e->getMessage();
    // }

    require('dbconnect.php');
    
    $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
    // $statement->execute(array($_POST['memo']));
    $statement->bindParam(1, $_POST['memo']);
    echo 'メッセージが登録されました';
    

?>
</pre>
</main>
</body>    
</html>