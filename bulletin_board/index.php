<?php 
session_start();
require('dbconnect.php');

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
        if (!isset($_REQUEST['res'])) {
            $_POST['reply_post_id'] = 0;
        }
        $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created=NOW()');
        $message->execute(array($member['id'], $_POST['message'], $_POST['reply_post_id']));
        header('Location: index.php');
        exit;
    }
}

$page = $_REQUEST['page'];
if ($page === '') {
    $page = 1;
}
$page = max($page, 1);

$counts   = $db->query('SELECT COUNT(*) AS cnt FROM posts');
$cnt      = $counts->fetch();
$max_page = ceil($cnt['cnt'] / 5);
$page     = min($page, $max_page);

$start = ($page -1) * 5;

$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY created DESC LIMIT ?,5');
$posts->bindParam(1, $start, PDO::PARAM_INT);
$posts->execute();

if (isset($_REQUEST['res'])) {
    $response = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
    $response->execute(array($_REQUEST['res']));
    $table = $response->fetch();
    $message = '@' . $table['name'] . '' . $table['message'];
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
    <a href="logout.php">ログアウトする</a>
    <dl>
      <dt><?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>さん、メッセージをどうぞ</dt>
      <textarea name="message" id="" cols="50" rows="10"><?php print(htmlspecialchars($message, ENT_QUOTES)) ?></textarea>
      <input type="hidden" name="reply_post_id" value="<?php print(htmlspecialchars($_REQUEST['res'], ENT_QUOTES)) ?>" >
      <input type="submit" value="投稿する">
    </dl>
  </form>

  <?php foreach ($posts as $post) : ?>
    <p><img src="member_picture/<?php print(htmlspecialchars($post['picture'], ENT_QUOTES)) ?>" alt="<?php print(htmlspecialchars($post['name'], ENT_QUOTES)) ?>"></p>
    <p><?php print(htmlspecialchars($post['message'], ENT_QUOTES)) ?></p>
    <p><a href="index.php?res=<?php print(htmlspecialchars($post['id'])) ?>">Re</a></p>
    <p><a href="view.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)) ?>"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)) ?></a></p>
    <?php if ($post['reply_message_id'] > 0) : ?>
      <p><a href="view.php?id=<?php print(htmlspecialchars($post['reply_message_id'])) ?>">返信元のメッセージ</a></p>
    <?php endif ?>
  <?php endforeach ?>


  <?php if ($page > 1) : ?>
    <a href="index.php?page=<?php print($page - 1) ?>">前のページ</a>
  <?php else : ?>
    <p>前のページ</p>
  <?php endif ?>
  <?php if ($page < $max_page) : ?>
    <a href="index.php?page=<?php print($page + 1) ?>">次のページ</a>
  <?php else : ?>
    <p>次のページ</p>
  <?php endif ?>
</body>
</html>
