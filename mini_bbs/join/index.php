<?php 
    session_start();

    require('../dbconnect.php');
    //ユーザーデータ（メールアドレス等の）重複を避けるために送信前のindexからもデータベースにアクセス

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

        $fileName = $_FILES['image']['name'];
        if (!empty($fileName)) {
            //画像は必須項目ではない
            //アップロードしている場合の処理
            $ext = substr($fileName, -3);
            //ファイルの後ろ三文字を切り取る処理
            //拡張子を得ることができる
            if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
                $error['image'] = 'type';
            }
        }

        //アカウントの重複をチェック
        if (empty($error)) {
            //メールアドレスがblankの状態だとメールアドレスが誤作動を起こす可能性
            //予めエラーチェックしてからチェック
            $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
            //件数が何件かを取得
            //cntというショートカットに格納
            //membersというテーブルからemailを絞り込む
            $member->execute(array($_POST['email']));
            $record = $member->fetch();
            //メールアドレスのメンバーがいれば1いなければ0が返ってくる
            if ($record['cnt'] > 0) {
                // === 0でも良いが...
                //$record['cnt']に2,3といった数字が入ってきた場合でも対応できるよう > 0
                $error['email'] = 'duplicate';
            }
        }

        //errorがない時に確認画面に推移する
        //errorが発生していない時の条件
        if (empty($error)) {
            $image = date('YmdHis') . $_FILES['image']['name'];
            //fileの処理
            //date('YmdHis') 日付
            //20181123151627my.face.pmg
            //ファイル名というのは同じ名前でファイルをアップする可能性があり、上書きされてしまうリスク
            //日付で重複回避
            //厳密には同じ時間にアップすると上書きされてしまう
            //方法として、アップロードされた画像をデータベースで連番を作り、ファイル名にして重複を避ける
            move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture' . $image);
            //$_FILESというグローバル変数はformのinput_fileから得られた内容
            //tmp_name 一時的にアップロードされている場所 このままだと消えてしまう恐れ、保存したい場所に保存する そのためにmove_uploaded_file
            //move_uploaded_file
            //1 パラメータ 今ある場所
            //2          移動先 移動先に$image内のファイルネームで保存する
            
            $_SESSION['join'] = $_POST;
            //エラーがない時に値を保存する
            $_SESSION['join']['image'] = $image;
            //作った画像ファイル名もデータベースに保存しなくてはならない sessionで保管
            //現状、写真以外もアップロードできてしまう
            //セキュリティ面で不安
            //エラーチェックを追加
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

if ($_REQUEST['action'] === 'rewrite' && isset($_SESSION['join'])) {
    $_POST = $_SESSION['join'];
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
            <!-- enctype=""multipart/form-data -->
            <!-- 決まり文句 ファイルのアップロードが必要な場合は記述 -->

<!-- formタグのaction属性が空 -->
<!-- 自分自身のページにジャンプさせてエラー内容をチェックする 全て正しければ次のcheck.phpへジャンプ -->
<!-- 一番上のif文でpostを受け取る -->

<!-- check.phpへはセッションで渡すのが良い -->
<!-- ブラウザを閉じた際に、入力画面に値を残す必要はないためcookieは使わない 個人情報は危険-->
<!-- check.phpで値を書き直す機能を作るため、$_POSTで渡すのは非効率  -->
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
            <?php if ($error['email'] === 'duplicate') : ?>
                <p class='error'>* 指定されたメールアドレスは既に登録されています</p>
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
            <!-- 写真 input="file" -->
            <!-- ファイルをアップロードする際にはformに特別な属性が必要 -->
            <!-- enctype=""multipart/form-data -->
            <!-- 決まり文句 ファイルのアップロードが必要な場合は記述 -->
            <?php if ($error['image'] === 'type') : ?>
                <p class="error">* 写真などは[.gif] または [.jpg] または [.png]の画像を指定してください v</p>
            <?php endif ?>
            <!-- パスワードを空にして画像をきちんと設定した場合に、画像の指定が消える -->
            <!-- もう一度画像を指定してもらう必要がある -->
            <!-- 下のコードで新たなエラーメッセージ作成 -->
            <?php if (!empty($error)) : ?>
                <p class="error">恐れ入りますが、画像を改めて指定してください</p>
            <?php endif ?>
        </dd>
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>
</body>
</html>