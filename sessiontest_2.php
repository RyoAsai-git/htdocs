<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo 'セッションを破棄しました';

        $_SESSION = [];

        if (isset($_COOKIE['PHPSESSID'])) {
            //クッキーにもセッション情報が残っている
            setcookie('PHPSESSID', '', time() - 1800, '/');
            //PHPSESSIDに空の情報を入れつつ
        }

        session_destroy();

        echo 'セッション';
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';

        echo 'クッキー';
        echo '<pre>';
        var_dump($_COOKIE);
        echo '</pre>';

    ?>
</body>
</html>