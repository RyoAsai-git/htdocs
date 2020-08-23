<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
    <?php 
      $week = ['金', '土', '日', '月', '火', '水', '木'];
      for ($i = 1; $i < 31; $i++) {
        print($week[$i % 7] . "\n");
      }
      
      //$iが1の時   $i % 7 あまり1　$week[1]土曜日
      //$iが2のとき $i % 7 あまり2  $week[2]日曜日
      //$iが7のとき あまり0　金曜日
    ?>
</pre>
<table>
  <tr>
    <td>１行目</td>
  </tr>
  <tr style="background-color: #ccc">
    <td>２行目</td>
  </tr>
  <tr>
    <td>１行目</td>
  </tr>
  <tr style="background-color: #ccc">
    <td>２行目</td>
  </tr>
</table>
<table> 
  <?php //上のテーブルをfor文にて
  for ($i = 1; $i<=10; $i++) {
    if ($i % 2) {
      print('<tr style="background-color: #ccc">');
    } else {
      print('<tr>');
    }
    print('<td>' . $i . '行目</td>');
    print('</tr>');
  }
  ?>
  <tr>

  </tr>
</table>
</main>
</body>    
</html>