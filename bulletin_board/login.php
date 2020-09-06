<?php
session_start();
require('dbconnect.php');

if ($_COOKIE['email'] !== '') {
    $email = $_COOKIE['email'];
}

if ($_COOKIE['password'] !== '') {
    $password = $_COOKIE['password'];
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    if ($_POST['email'] !== '' && $_POST['password'] !== '') {
        $login = $db->prepare('SELECT * FROM members WHERE email=? AND password=?');
        $login->execute(array($_POST['email'], sha1($_POST['password'])));
        $member = $login->fetch();
        if ($member) {
            $_SESSION['id']   = $member['id'];
            $_SESSION['time'] = time();
            if ($_POST['save'] === 'on') {
                setcookie('email' , $_POST['email'], time()+ 60 * 60 * 24 * 14);
                setcookie('password' , $_POST['password'], time() + 60 * 60 * 24 * 14);
            }
            header('Location: index.php');
            exit;
        } else {
            $error['login'] = "failed";
        }
    } else {
        if ($_POST['email'] === '' ) {
            $error['email'] = 'blank';
        }
        if ($_POST['password'] === '') {
            $error['password'] = 'blank';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログインする</title>
</head>
<body>
  <h1>ログインする</h1>
  <p>会員登録がお済みでない方はこちら</p>
  <p><a href="join/">会員登録をする</a></p>
  <form action="" method="post">
    <dl>
      <dt>メールアドレス</dt>
      <dd>
        <input type="text" name="email" maxlength="255" value="<?php print(htmlspecialchars($email)) ?>">
        <?php if ($error['email'] === 'blank') : ?>
          <p>メールアドレスを入力してください</p>
        <?php endif ?>
        <?php if ($error['login'] === 'failed') : ?>
          <p>ログインに失敗しました。正しいユーザー情報を入力してください</p>
        <?php endif ?>
        </dd>
      <dt>パスワード</dt>
      <dd>
        <input type="password" name="password" maxlength="100" value="<?php print(htmlspecialchars($password)) ?>">
        <?php if ($error['password'] === 'blank') : ?>
          <p>パスワードを入力してください</p>
        <?php endif ?>
      </dd>
      <dt>ログイン情報を記録する</dt>
      <input id="save" type="checkbox" name="save" value="on">
      <label for="save">次回からは自動的にログインする</label>
    </dl>
    <input type="submit" value="ログインする">
  </form>
</body>
</html>