<?php 
session_start();
require('dbconnect.php');

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
$posts->execute(array($_REQUEST['id']));
$post = $posts->fetch();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php if($post) : ?>
    <p><img src="member_picture/<?php print(htmlspecialchars($post['picture'])) ?>" alt=""></p>
    <p><?php print(htmlspecialchars($post['message'])) ?></p>
    <p><?php print(htmlspecialchars($post['created'])) ?></p>
  <?php else : ?>
    <p>その投稿は削除されたか、URLが間違っています</p>
  <?php endif ?>

</body>
</html>