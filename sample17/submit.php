<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
  お名前 :  <?php 
    print(htmlspecialchars($_REQUEST['my_name'], ENT_QUOTES)); ?>
    <!-- $_REQUEST グローバル変数 name属性の値が入る 指定したフォームの値を受け取ることができる -->
    <!-- $_GET $_REQUESTと同じように動作 -->
    <!-- $_GETはurlに載せてformの値を送信 -->
    <!-- $_POSTはurlに載せない 裏側で送信 -->
    <!-- ここでは$_POSTが動かない formを作成したmethod属性がget method属性と合わせる-->
    <!-- methodがわからない場合 $_REQUEST getもpostも受け取ることができる postで送るべき情報はpost passwordなどを 安全性の観点から-->
    <!-- 危険な文字列 htmlspecialchars htmlのタグとして認識される文字列をescapeする -->
    <!-- ex htmlspecialcharsへ<strong>悪戯</strong>  タグが認識され表示される JavaScriptと組み合わせた危険なプログラムを防ぐ -->
    <!-- １つ目のパラメーターで何をescapeするか 2つ目 どのようにescapeするか -->
    <!-- ENT_QUOTES 基本的にはこれ 定義済み定数 -->
</pre>
</main>
</body>    
</html>