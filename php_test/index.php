<!Doctype html>
<head></head>
  <body>
    こちらはHTMLです

    <?php 
      echo ('こちらはPHP');
      echo ('<br>');
      echo ('こんにち""は');
      phpinfo();

      //php 動的型付け int stringを自動的に判断  Javaなど静的型付け int() string()と型を指定する必要
      
      $test_1 = 123;
      $test_2 = 456;
      $test_3 = $test_1 . $test_2;
      echo $test_3;
      //string型で出力 二つの変数を繋げるとstringになる
    ?>
  </body>
</html>
