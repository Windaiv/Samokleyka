<?php 
session_start();
define( 'IPS_DOC_CHAR_SET', 'UTF-8' );
$dd=$_POST['n'];

unset($_SESSION['mas'][$dd]);
sort($_SESSION['mas']);
reset($_SESSION['mas']);

header('Location: korzina.php');
?>