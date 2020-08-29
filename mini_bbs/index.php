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

if (!empty($_POST)) {
    if ($_POST['message'] !== '') {
        $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created=NOW();');
        //reply_message_idはどの投稿に対しての返信かを記録したカラム
        $message->execute(array($member['id'], $_POST['message'], $_POST['reply_post_id']));
        //このコードではブラウザで再読み込みした時点でPOSTの値が複数送信されてしまう
        
        header('Location: index.php');
        exit;
        //POSTの処理が終わった後、自分自身をもう一度呼び出す
        //動きはほとんど変わらない
    }
}

$posts = $db->query('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY created DESC');
//member postsの二つのテーブルをリレーション
//p.*はpostテーブルの全ての値

if (isset($_REQUEST['res'])) {
    //reというリンクがクリックされた場合
    //返信処理
    $response = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=?');
    $response->execute(array($_REQUEST['res']));

    $table = $response->fetch();
    $message = '@' . $table['name'] . '' . $table['message'];
    //実際はエラー処理を入れても良い
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
          <textarea name="message" cols="50" rows="5"><?php print(htmlspecialchars($message, ENT_QUOTES)) ?></textarea>
          <!-- textareaはvalue属性が存在しない -->
          <!-- 代わりに開きタグ 閉じタグが存在する その間に値を入れると出力される-->
          <input type="hidden" name="reply_post_id" value="<?php print(htmlspecialchars($_REQUEST['res'], ENT_QUOTES)) ?>" />
        </dd>
      </dl>
      <div>
        <p>
          <input type="submit" value="投稿する" />
        </p>
      </div>
    </form>

<?php foreach ($posts as $post) : ?>
    <div class="msg">
    <img src="member_picture/<?php print(htmlspecialchars($post['picture'], ENT_QUOTES)); ?>" width="48" height="48" alt="name" />
    <!-- alt属性 画像が表示されなかった時に出力されるもの -->
    <p><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?><span class="name">（<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>）
    </span>[<a href="index.php?res=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)) ?>">Re</a>]</p>
    <!-- 返信機能 -->
    <p class="day"><a href="view.php?id="><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></a>
<a href="view.php?id=">
返信元のメッセージ</a>
[<a href="delete.php?id="
style="color: #F33;">削除</a>]
    </p>
    </div>
<?php endforeach ?>

<ul class="paging">
<li><a href="index.php?page=">前のページへ</a></li>
<li><a href="index.php?page=">次のページへ</a></li>
</ul>
  </div>
</div>
</body>
</html>
