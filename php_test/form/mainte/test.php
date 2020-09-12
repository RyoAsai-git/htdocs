<?php
//パスワードを記録したファイルの場所
echo __FILE__;
// /Applications/MAMP/htdocs/php_test/form/mainte/test.php



//パスワード(暗号化)
//crypt
//password_hash

echo '<br>';
echo (password_hash('password123', PASSWORD_BCRYPT));
//1 パスワード
//2 パスワードの暗号化の種類

