<?php

require('../dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['name'] === '') {
        $error['name'] = 'blank';
    }

    if ($_POST['email'] === '') {
        $error['email'] = 'blank';
    }

    if ($_POST['password'] === '') {
        $error['password'] = 'blank';
    }

    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }

    $fileName = $_FILES['picture']['name'];
    if (!empty($fileName)) {
        $exe = substr($fileName, -3);
        if ($exe != 'jpg' && $exe != 'png' && $exe != 'gif') {
            $error['picture'] = 'type';
        }
    }
    
    if (empty($error)) {
        $image = date('YmdHis') . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], '../member_picture' . $image);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>会員登録</title>
</head>
<body>
  <h1>会員登録</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <dl>
      <dt>ニックネーム</dt>
      <dd>
        <input type="text" name="name" maxlength="100" value="">
        <?php if ($error['name'] === 'blank') : ?>
          <p>ニックネームを入力してください</p>
        <?php endif ?>
      </dd>
    </dl>
    <dl>
      <dt>メールアドレス</dt>
      <dd>
        <input type="text" name="email" maxlength="255" value=""> 
        <?php if ($error['email'] === 'blank') : ?>
          <p>メールアドレスを入力してください</p>
        <?php endif ?>
      </dd>
    </dl>
    <dl>
      <dt>パスワード</dt>
      <dd>
        <input type="password" name="password" maxlength="100" value="">
        <?php if ($error['password'] === 'blank') : ?>
          <p>パスワードを入力してください</p>
        <?php endif ?>
        <?php if ($error['password'] === 'length') : ?>
          <p>パスワードは4文字以上で入力してください</p>
        <?php endif ?>
      </dd>
    </dl>
    <dl>
      <dt>プロフィール画像</dt>
      <dd>
        <input type="file" name="picture" value="">
        <?php if ($error['picture'] === 'type') : ?>
          <p>画像の形式は'jpg'か'png'か'gif'で指定してください</p>
        <?php endif ?>
        <?php if (!empty($error)) : ?>
          <p>お手数ですが、画像を改めて指定してください</p>
        <?php endif ?>
      </dd>
    </dl>
    <input type="submit" value="入力内容を確認する">
  </form>
</body>
</html>