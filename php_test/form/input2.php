<?php

header('X-FRAME-OPTIONS:DENY');
//クリックジャッキング対策
//重ねて表示はできないことを明示

function h ($str) {
    // <!-- htmlspecialcharsを省略しh -->
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
 
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
 
$pageFlag = 0;
 
if (!empty($_POST["btn_confirm"])){
    $pageFlag = 1;
}
 
if (!empty($_POST["btn_submit"])){
    $pageFlag = 2;
}
 
?>
 
<!DOCTYPE html>
<meta charset="utf-8">
<head></head>
<body> 
  <?php if($pageFlag === 1) : ?>
    <form method="POST" action="input2.php">
      名前
      <?php echo h($_POST["your_name"]) ; ?>
      <!-- htmlspecialcharsを省略しh -->
      <br>
      メールアドレス
      <?php echo h($_POST["email"]) ; ?>
      <!-- htmlspecialcharsを省略しh -->
      <input type="submit" name="back" value="戻る">
      <!-- 戻るが押されるとphpないの処理である$pageFlagが0に戻る -->
      <!-- $_POST['btn_submit']がからのため empty -->
      <input type="submit" name="btn_submit" value="送信する">
      <input type="hidden" name="your_name" value="<?php echo h($_POST["your_name"]) ; ?>">
      <input type="hidden" name="email" value="<?php echo h($_POST["email"]) ; ?>">
    </form>
  <?php endif; ?>
  
  <?php if($pageFlag === 2) : ?>
    送信が完了しました
  <?php endif; ?>
  
  <?php if($pageFlag === 0) : ?>
    <form method="POST" action="input2.php">
      名前
      <input type="text" name="your_name" value="<?php echo h($_POST['your_name']) ?>">
      <br>
      メールアドレス
      <input type="email" name="email" value="<?php echo h($_POST['email']) ?>">
      <input type="submit" name="btn_confirm" value="確認する">
    </form>
  <?php endif; ?>
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
  

<!-- CSRF Cross Site Request Forgeries -->
<!-- SQLインジェクション -->

<!-- 対策 -->
<!-- サニタイズ バリデーション -->