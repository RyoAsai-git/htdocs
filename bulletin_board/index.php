<?php 
require('dbconnect.php');

if (!empty($_POST)) {
    if ($_POST['message'] !== '') {
        $message = $db->prepare('INSERT INTO posts SET id=1, member_id=1, message=?, reply_message_id=1, created=NOW()');
        $message->execute(array($_POST['message']));
        header('Location: index.php');
        exit;
    }
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
  <form action="" method="post">
      <textarea name="message" id="" cols="50" rows="10"></textarea>
      <input type="submit" value="送信する">
  </form>
</body>
</html>