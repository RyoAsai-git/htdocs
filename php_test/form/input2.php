<?php
 
echo "<pre>";
var_dump($_POST);
echo "</pre>";
 
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
      <?php echo $_POST["your_name"] ; ?>
      <br>
      メールアドレス
      <?php echo $_POST["email"] ; ?>
      <input type="submit" name="btn_submit" value="送信する">
      <input type="hidden" name="your_name" value="<?php echo $_POST["your_name"] ; ?>">
      <input type="hidden" name="email" value="<?php echo $_POST["email"] ; ?>">
    </form>
  <?php endif; ?>
  
  <?php if($pageFlag === 2) : ?>
    送信が完了しました
  <?php endif; ?>
  
  <?php if($pageFlag === 0) : ?>
    <form method="POST" action="input2.php">
      名前
      <input type="text" name="your_name">
      <br>
      メールアドレス
      <input type="email" name="email">
      <input type="submit" name="btn_confirm" value="確認する">
    </form>
  <?php endif; ?>
</body>
</html>