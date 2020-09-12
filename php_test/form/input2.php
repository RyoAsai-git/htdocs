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
 
 <!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
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

    <div class="container">
      <div class="row">
        <div class="col-md-6">
        <!-- bootstrapは画面を12分割して考える -->
        <!-- ここでは12分割した半分を使っている -->
        <!-- md 画面幅が720pxより小さくなったら100%で表示する -->
          <form method="POST" action="input2.php">
          <div class="form-group">
            <label for="your_name">氏名 </label>
            <input type="text" class="form-control" id="your_name" name="your_name" value="<?php echo h($_POST['your_name']) ?>" required>
            <!-- required 必須項目に記述 -->
          </div>
          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo h($_POST['email']) ?>" required>
            <!-- エラーチェックの際にtype="email"という形でhtml側で既にバリデーションがかかっている -->
          </div>
          <div class="form-group">
            <label for="url">ホームページ</label>
            <input type="url" class="form-control" id="url" name="url" value="<?php echo h($_POST['url']) ?>">
            <!-- エラーチェックの際にtype="url"という形でhtml側で既にバリデーションがかかっている -->
          </div>
      

          <div class="form-check form-check-inline">性別
            <input class="form-check-input" id="gender1" type="radio" name="gender" value="male">
            <label class="form-check-label" for="gender1">男性</label>
            <input class="form-check-input" id="gender2" type="radio" name="gender" value="female">
            <label class="form-check-label" for="gender2">女性</label>
          </div>

          <div class="form-group">
            <label for="age">年齢</label>
              <select class="form-control" id="age" name="age">
                <option value="">選択してください</option>
                <option value="1">〜19歳</option>
                <option value="2">20歳〜29歳</option>
                <option value="3">30歳〜39歳</option>
                <option value="4">40歳〜49歳</option>
                <option value="5">50歳〜59歳</option>
                <option value="6">60歳〜</option>
              </select>
          </div>

          <div class="form-group">
            <label for="contact">お問い合わせ内容</label>
            <textarea class="form-control" id="contact" row="3" name="contact" value="<?php echo h($_POST['contact']) ?>"></textarea>
          </div>
          
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="caution">
            <label class="form-check-label" for="caution">注意事項に同意する</label>
          </div>

      <input class="btn btn-info" type="submit" name="btn_confirm" value="確認する">
      <input type="hidden" name="csrf" value="<?php echo $token ?>">
      <!-- 合言葉を設定 -->
    </form>
    </div>
    </div>
    </div>
  <?php endif ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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