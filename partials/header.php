<?php
include "functions.php";
ini_set(option: 'display_errors', value:1);
ini_set(option: 'display_startup_errors', value:1);
error_reporting(error_level:E_ALL);

session_start();

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login App SQL/PHP</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/admin.css">

</head>

<body class="<?php echo getPageClass() ?>">