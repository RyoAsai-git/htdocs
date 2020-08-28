<?php
session_start();
//login.phpで作成した$_SESSIONにidとログイン時間が入っていればログインできていると判定し、このページを表示できるとする
require('dbconnect.php');
 
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //セッションに記録された時間に１時間を足した値が現在の時刻よりも大きい場合 １時間何もしていなとログアウトする
    //ここではログインしている時の処理
    $_SESSION['time'] = time();
    //何か行動を起こした時にtimeで上書きしてあげることで、最後の行動から１時間動きが有効になる
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
    //これによりログインしているユーザー情報がデータベースから引出された
} else {
  header('Location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>

	<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ひとこと掲示板</h1>
  </div>
  <div id="content">
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
    <form action="" method="post">
      <dl>
        <dt><?php print(htmlspecialchars($member['name'], ENT_QUOTES)) ?>さん、メッセージをどうぞ</dt>
        <dd>
          <textarea name="message" cols="50" rows="5"></textarea>
          <input type="hidden" name="reply_post_id" value="" />
        </dd>
      </dl>
      <div>
        <p>
          <input type="submit" value="投稿する" />
        </p>
      </div>
    </form>

    <div class="msg">
    <img src="member_picture" width="48" height="48" alt="" />
    <p><span class="name">（）</span>[<a href="index.php?res=">Re</a>]</p>
    <p class="day"><a href="view.php?id="></a>
<a href="view.php?id=">
返信元のメッセージ</a>
[<a href="delete.php?id="
style="color: #F33;">削除</a>]
    </p>
    </div>

<ul class="paging">
<li><a href="index.php?page=">前のページへ</a></li>
<li><a href="index.php?page=">次のページへ</a></li>
</ul>
  </div>
</div>
</body>
</html>
