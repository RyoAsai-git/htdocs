<?php 
require('dbconnect.php');
session_start();

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    $_SESSION['time'] = time();
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
} else {
    header('Location: login.php');
    exit;
}

if (!empty($_POST)) {
    if ($_POST['message'] !== '') {
        $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=0, created=NOW()');
        $message->execute(array($member['id'], $_POST['message']));
        header('Location: index.php');
        exit;
    }
}

$posts = $db->prepare('SELECT m.name, m.picture p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY created DESC');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action="" method="post">
    <dl>
      <dt><?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>さん、メッセージをどうぞ</dt>
      <textarea name="message" id="" cols="50" rows="10"></textarea>
      <input type="submit" value="投稿する">
    </dl>
  </form>
</body>
</html>