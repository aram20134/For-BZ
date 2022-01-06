<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
<link rel="stylesheet" href="glav.css?71">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
</head>
<body>
<header class="head">
    <div class="head-content">
        <div style="display: flex; align-items:center;">
            <a href="https://swrpngg.space/" id="btn-logo"></a>
            <a href="https://swrpngg.space/" style="text-decoration:none;"><p id="text-logo">STAR WARS RP NGG</p></a>
        </div>
        <a href="swrp1" class="btn-head">SWRP Phase 1</a>
        <a href="swrp2" class="btn-head">SWRP Phase 2</a>
        <?php 
        	if(isset($_SESSION['logged_user'])) {
        		$a = " | ";
        		echo '<a href ="profile" class ="reg-head">'. $_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name. '</a>';
        		echo '<a href ="logout" class ="reg-logout"> Выйти </a>';
        	} else {
        		echo '<a href="login" class="reg-head">Войти</a>';
        		echo '<a href="signup" class="reg-head">Зарегистрироваться</a>';
        	}
    	?>
    </div>
</header>