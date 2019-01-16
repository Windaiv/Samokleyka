<?php
session_start();
define( 'IPS_DOC_CHAR_SET', 'UTF-8' );
session_destroy();
header('Location: index.php');

exit;

?>

