<?php 
    session_start();
    require('dbconnect.php');

    if (!empty($_POST)) {
        if ($_POST['email'] !== '' && $_POST['password'] !== '') {
            //email、passwordが空ではないとき、ログインチェックをする
            //丁寧に作るのであればメールアドレスが入力されていません、パスワードが入力されていませんと書くべき
            $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
            // $login->execute(array($_POST['email'], $_POST['password']));
            //上の処理は正しく動かない
            //データベースのpasswordは暗号化 sha1 不可逆暗号 元に戻せない
            //ここで出力するのはユーザーの生のパスワード
            //ここのSQLではユーザーの生のパスワードとデータベースの暗号化を比較するため、両者が一致することはないから

            //sha1 ユーザーがパスワードを忘れた際に、元に戻せない //管理者であっても難しい
            //これを使う意味は?
            //同じsha1で暗号化した文字は同じ暗号になるというルールがある
            $login->execute(array($_POST['email'], sha1($_POST['password'])));
            $member = $login->fetch();
            //fetchでデータが返ってきていればログインに成功している
            if ($member) {
                $_SESSION['id']   = $member['id'];
                $_SESSION['time'] = time();
                //セッション変数にはパスワードは保存しないようにする
                //クッキーより安全性が高いといってもセッションハイジャックという行為でデータ抜き出されるのは不正ログインの原因になる
                header('Location: index.php');
                exit;
            } else {
                //ログイン失敗処理
                //パスワードが間違っている
                $error['login'] = 'failed';
            }
        } else {
            //emailかpasswordのどちらかが空のときの処理
            $error['login'] = 'blank';
        }
    }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ログインする</title>
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ログインする</h1>
  </div>
  <div id="content">
    <div id="lead">
      <p>メールアドレスとパスワードを記入してログインしてください。</p>
      <p>入会手続きがまだの方はこちらからどうぞ。</p>
      <p>&raquo;<a href="join/">入会手続きをする</a></p>
    </div>
    <form action="" method="post">
        <!-- action属性が空 -->
        <!-- login.php自体でエラーがないか確認し、なければ別のページにジャンプする処理を行うため -->
      <dl>
        <dt>メールアドレス</dt>
        <dd>
          <input type="text" name="email" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['email'], ENT_QUOTES)) ?>" />
          <?php if ($error['login'] === 'blank') : ?>
            <p class="error">* メールアドレスとパスワードをご記入ください</p>
          <?php endif ?>
          <?php if ($error['login'] === 'failed') : ?>
            <p class="error">ログインに失敗しました。正しくご記入ください</p>
          <?php endif ?>
        </dd>
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)) ?>" />
        </dd>
        <dt>ログイン情報の記録</dt>
        <dd>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">次回からは自動的にログインする</label>
        </dd>
      </dl>
      <div>
        <input type="submit" value="ログインする" />
      </div>
    </form>
  </div>
  <div id="foot">
    <p><img src="images/txt_copyright.png" width="136" height="15" alt="(C) H2O Space. MYCOM" /></p>
  </div>
</div>
</body>
</html>
