<?php

session_start();

require('validation.php');

header('X-FRAME-OPTIONS:DENY');
//クリックジャッキング対策
//重ねて表示はできないことを明示

function h ($str) {
    // <!-- htmlspecialcharsを省略しh -->
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
 
echo "<pre>";
var_dump($_POST);
echo "</pre>";
 
$pageFlag = 0;
$error = validation($_POST);
 
if (!empty($_POST["btn_confirm"]) && empty($error)) {
    $pageFlag = 1;
}
 
if (!empty($_POST["btn_submit"])) {
    $pageFlag = 2;
}
 
?>
 
<!DOCTYPE html>
<meta charset="utf-8">
<head></head>
<body> 
  <?php if($pageFlag === 1) : ?>
    <!-- 確認画面 -->
    <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
      <form method="POST" action="input2.php">
        氏名
        <?php echo h($_POST["your_name"]) ; ?>
        <!-- 関数 -->
        <!-- htmlspecialcharsを省略しh -->
        <br>
        メールアドレス
        <?php echo h($_POST["email"]) ; ?>
        <!-- 関数 -->
        <!-- htmlspecialcharsを省略しh -->
        <br>
        ホームページ
        <?php echo h($_POST['url']) ?>
        <br>
        性別
        <?php if ($_POST['gender'] === '0'){echo '男性';}
              if ($_POST['gender'] === '1'){echo '女性';} 
        ?>
        <br>
        年齢
        <?php if ($_POST['age'] === '1'){echo '〜19歳';}
              if ($_POST['age'] === '2'){echo '20歳〜29歳';}
              if ($_POST['age'] === '3'){echo '30歳〜39歳';}
              if ($_POST['age'] === '4'){echo '40歳〜49歳';}
              if ($_POST['age'] === '5'){echo '50歳〜59歳';}
              if ($_POST['age'] === '6'){echo '60歳〜';}
        ?>
        <br>
        お問い合わせ内容
        <?php echo h($_POST['contact']) ?>

        <input type="submit" name="back" value="戻る">
        <!-- 戻るが押されるとphpないの処理である$pageFlagが0に戻る -->
        <!-- $_POST['btn_submit']がからのため empty -->
        <input type="submit" name="btn_submit" value="送信する">
        <input type="hidden" name="your_name" value="<?php echo h($_POST["your_name"]) ; ?>">
        <input type="hidden" name="email" value="<?php echo h($_POST["email"]) ; ?>">
        <input type="hidden" name="url" value="<?php echo h($_POST["url"]) ; ?>">
        <input type="hidden" name="gender" value="<?php echo h($_POST["gender"]) ; ?>">
        <input type="hidden" name="age" value="<?php echo h($_POST["age"]) ; ?>">
        <input type="hidden" name="contact" value="<?php echo h($_POST["contact"]) ; ?>">

        <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
      </form>
    <?php endif ?>
  <?php endif ?>
  
  <?php if($pageFlag === 2) : ?>
    <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) : ?>
      送信が完了しました
      <?php unset($_SESSION['csrfToken']) ?>
    <?php endif ?>
  <?php endif; ?>
  
  <?php if($pageFlag === 0) : ?>
    <!-- 最初の画面 -->
    <!-- <?php echo random_bytes(32) ?> -->
    <!-- CSRF対策 暗号 -->
    <!-- このままだと文字化けするので16進数に変換 -->
    <?php if (!isset($_SESSION['csrfToken'])) : ?>
      <?php $csrfToken = bin2hex(random_bytes(32)) ?>
      <?php $_SESSION['csrfToken'] = $csrfToken ?>
    <!-- これを変数へ格納 -->
    <?php endif ?>
    
    <?php $token = $_SESSION['csrfToken'] ?>
    
    <?php if (!empty($_POST['btn_confirm']) && !empty($error)) : ?>
      <!-- btn_confirmが押されている=確認ボタンが押されている && エラーに何か入っているとき -->
      <!-- エラー表示 -->
      <ul>
        <?php foreach ($error as $value) : ?>
          <li><?php echo $value ?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>

    <form method="POST" action="input2.php">
      氏名
      <input type="text" name="your_name" value="<?php echo h($_POST['your_name']) ?>">
      <br>
      メールアドレス
      <input type="text" name="email" value="<?php echo h($_POST['email']) ?>">
      <!-- エラーチェックの際にtype="email"という形でhtml側で既にバリデーションがかかっている -->
      <br>
      ホームページ
      <input type="text" name="url" value="<?php echo h($_POST['url']) ?>">
      <!-- エラーチェックの際にtype="url"という形でhtml側で既にバリデーションがかかっている -->
      <br>
      性別
      <input type="radio" name="gender" value="0">男性
      <input type="radio" name="gender" value="1">女性
      <br>
      年齢
      <select name="age">
         <option value="">選択してください</option>
        <option value="1">〜19歳</option>
        <option value="2">20歳〜29歳</option>
        <option value="3">30歳〜39歳</option>
        <option value="4">40歳〜49歳</option>
        <option value="5">50歳〜59歳</option>
        <option value="6">60歳〜</option>
      </select>
      <br>
      お問い合わせ内容
      <textarea name="contact" value="<?php echo h($_POST['contact']) ?>"></textarea>
      <br>
      <input type="checkbox" name="caution" value="1">注意事項にチェックする
      <br>

      <input type="submit" name="btn_confirm" value="確認する">
      <input type="hidden" name="csrf" value="<?php echo $token ?>">
      <!-- 合言葉を設定 -->
    </form>
  <?php endif ?>
</body>
</html>

<!-- formが狙われる代表的な攻撃 -->

<!-- XSS Cross-Site Scripting -->
  <!--悪意を持った攻撃者 -->
  <!-- formで<script>alert('攻撃');</alert> -->
  <!-- JSでできることで攻撃できてしまう サニタイズする htmlspecialcharsを用いる -->

<!-- クリックジャッキング -->
  <!-- クリックするボタンをのっとる -->
  <!-- ボタンの上にcssで透明にしたボタンを気づかずにクリックさせる -->
  <!-- サーバー側とphp側の対策 -->
  

<!-- CSRF Cross-Site Request Forgeries -->
  <!-- 偽物のinput.phpに情報を入れさせる -->
  <!-- 確認画面で全く違う情報が表示させられる こんにちはと入力したら爆破予告になる passwordを入力したら抜き取られるなど -->
  <!-- 対策として、偽のinputから情報が来てるのか本物から来てるのかを見分ける必要 -->
  <!-- 合言葉で本物か判断 -->
  <!-- $_SESSIONを使う トークンを発行-->

<!-- SQLインジェクション -->
<!-- アプリケーションが想定しないSQLを実行する -->

<!-- 対策 -->
<!-- サニタイズ バリデーション -->

<!-- バリデーション -->
<!-- 文字 未入力 -->
    <!-- 氏名未入力だと名無しになってしまう 100文字などの現実的な氏名ではない -->
<!-- メールアドレス 未入力 1つだけか-->
<!-- 性別などの選択項目 未入力 -->
<!-- 郵便番号 電話番号 カナ -->