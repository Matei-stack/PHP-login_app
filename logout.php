<?php
session_start();
$_SESSION = [];
session_destroy();
header(header:"Location: login.php");
exit;
?>