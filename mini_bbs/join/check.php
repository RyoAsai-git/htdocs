<?php 

    require('../dbconnect.php');

    session_start();

    if (!isset($_SESSION['join'])) {
        // $_SESSIONに値がない場合の処理
        //入力画面を正しく通らず、check.phpが呼び出された場合の処理
        header('location: index.php');
        //index.phpへ移動
        exit();
    }

    if (!empty($_POST)) {
        $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()');

        echo $statement->execute(array(
            $_SESSION['join']['name'],
            $_SESSION['join']['email'],
            sha1($_SESSION['join']['password']), //そのまま記録するのはセキュリティ的にまずい sha1を使う 暗号化
            $_SESSION['join']['image'],
        ));

        unset($_SESSION['join']); //データベースの値を記録したのでセッションの内容は必要なくなった
        //セッションに値が残っているとデータベースに値が重複して保存されるリスクがある
        //使い終わったセッションはすぐに空にする

        header('Location: thanks.php');
        exit;
    }
    //check.phpは二回呼び出されている
    //確認ボタンを押した際に既にデータベースに保存されている 書き直す前選択をする前に会員登録が済んでしまう
    //データベースに値を登録するのは登録ボタンが押された際に保存
    //if文で制御



?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>

	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div id="wrap">
<div id="head">
<h1>会員登録</h1>
</div>

<div id="content">
<p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
<form action="" method="post">
	<input type="hidden" name="action" value="submit" />
	<dl>
		<dt>ニックネーム</dt>
		<dd>
            <?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)) ?>
        </dd>
		<dt>メールアドレス</dt>
		<dd>
            <?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)) ?>
        </dd>
        <dt>パスワード</dt>
		<dd>
        【表示されません】
        <!-- 安全性の観点から表示しない -->
		</dd>
		<dt>写真など</dt>
		<dd>
            <?php if ($_SESSION['join']['image'] !== '') : ?>
              <img src="../member_picture<?php print(htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES))?>" alt="">
            <?php endif ?>
		</dd>
	</dl>
    <div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
    <!-- ブラウザのヒストリー機能 戻るボタンなどを使うと 値が書き直す際保存されておらず、全て消えていることがある 再度全て入力する必要 -->
    <!-- 登録内容を修正できるようにする -->
    <!-- URLパラメータにaction=rewrite 書き直し -->

</form>
</div>

</div>
</body>
</html>
