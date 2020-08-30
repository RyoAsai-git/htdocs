<?php
session_start();

$_SESSION = [];
if (ini_get('session.use_cookies')) {
    //セッションにクッキーを使うかどうか判断するための設定ファイル
    $params = session_get_cookie_params();
    setcookie(session_name() . '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    //クッキーの有効期限を切る
    //セッションのクッキーが持っているオプションを指定し、クッキーを削除
}
session_destroy();
//セッションを完全に消す

setcookie('email', '', time()-3600);
header('Location: login.php');
exit;