<?php

session_start();
require('dbconnect.php');
if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){

    $_SESSION['time'] =time();
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();

}else{
    header('Location: logout.php');
    exit();
}

?>



<?php
session_start();
require('dbconnect.php');
 
if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();
 
  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  header('Location: login.php');
  exit();
}
?>