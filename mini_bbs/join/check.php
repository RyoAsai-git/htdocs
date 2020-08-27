<?php 
    session_start();

    if (!isset($_SESSION['join'])) {
        // $_SESSIONに値がない場合の処理
        //入力画面を正しく通らず、check.phpが呼び出された場合の処理
        header('location: index.php');
        //index.phpへ移動
        exit;
    }

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
