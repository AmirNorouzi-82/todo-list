<?php
include( 'includes/init.php' );
if( ! is_login() ){
    redirect('login.php');
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>پنل کاربری</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="css/panel.css">
</head>
<body>
    <div class="panel-container">