<?php
require('../dbconnect.php');
session_start();

if (!isset($_SESSION['join'])) {
    header('Location: index.php');
    exit;
}

if (!empty($_SESSION['join'])) {
    $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()');
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <dl>
    <dt>ニックネーム</dt>
    <dd><?php print(htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)) ?></dd>
  </dl>
  <dl>
    <dt>メールアドレス</dt>
    <dd><?php print(htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)) ?></dd>
  </dl>
  <dl>
    <dt>パスワード</dt>
    <dd>パスワードは表示されません</dd>
  </dl>
  <dl>
    <dt>プロフィール画像</dt>
    <dd>
      <?php if(!empty($_SESSION['join']['picture'])) : ?>
        <img src="../member_picture<?php print(htmlspecialchars($_SESSION['join']['picture'], ENT_QUOTES)) ?>" alt="">
      <?php endif ?>
    </dd>
  </dl>
</body>
</html>