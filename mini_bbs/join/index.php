<?php 
    if (!empty($_POST)) {
        //formが送信されているかどうかは$_POSTが空かどうかで判断できる
        //$_POSTが空ではない時にエラーチェックを走らせる
        //こうすることでformを送信する時にエラーチェックを行うことができる
        //入力内容確認ボタンを押すことでformが送信され、エラーチェック
        if ($_POST['name'] === '') {
            $error['name'] = 'blank';
        }
        //セッションを使う関係で下のformタグへif文を持っていけない

        if ($_POST['email'] === '') {
            $error['email'] = 'blank';
        }
        if (strlen($_POST['password']) < 4) {
            $error['password'] = 'length';
        }
        //strlen 指定した文字数を図り、数字で返す
        //ここでエラーの配列にlengthを入れることで下で $error['password] === 'length'のエラーを出力できる
        if ($_POST['password'] === '') {
            $error['password'] = 'blank';
        }
        //errorがない時に確認画面に推移する
        //errorが発生していない時の条件
        if (empty($error)) {
            header('Location: check.php');
            exit();
        }
        //画面を呼び出した直後にlengthのエラーが発生
        //why
        //上記のエラーチェックが画面が呼び出されただけの時も走っている
        //入力内容を確認するボタンを押した時に判断すべき
        //ボタンを押したかどうかはphpでは判断できない
        //formが送信されたかどうかを判断する
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
<p>次のフォームに必要事項をご記入ください。</p>
<form action="" method="post" enctype="multipart/form-data">
<!-- formタグのaction属性が空 -->
<!-- 自分自身のページにジャンプさせてエラー内容をチェックする 全て正しければ次のcheck.phpへジャンプ -->
<!-- 一番上のif文でpostを受け取る -->
	<dl>
		<dt>ニックネーム<span class="required">必須</span></dt>
		<dd>
            <input type="text" name="name" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)) ?>" />
            <?php if ($error['name'] === 'blank') : ?>
                <p class='error'>* ニックネームを入力してください</p>
            <?php endif ?>
		</dd>
		<dt>メールアドレス<span class="required">必須</span></dt>
		<dd>
            <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)) ?>" />
            <?php if ($error['email'] === 'blank') : ?>
                <p class='error'>* メールアドレスを入力してください</p>
            <?php endif ?>
		<dt>パスワード<span class="required">必須</span></dt>
		<dd>
            <input type="password" name="password" size="10" maxlength="20" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)) ?>" />
            <?php if ($error['password'] === 'blank') : ?>
                <p class='error'>* パスワードを入力してください</p>
            <?php endif ?>
            <?php if($error['password'] === 'length') :?>
                <p class='error'>* パスワードは4文字以上で入力してください</p>
            <?php endif ?>
        </dd>
		<dt>写真など</dt>
		<dd>
        	<input type="file" name="image" size="35" value="test"  />
        </dd>
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>
</body>
</html>