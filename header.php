<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="e4c9572b8cc0685c" />
    <title><?php echo $title; ?></title>
	<link rel="stylesheet" href="glav.css?137">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(87038010, "init", {
        clickmap:false,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/87038010" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>
<header class="head">
    <div class="head-content">
        <div style="display: flex; align-items:center;">
            <a href="." id="btn-logo"></a>
            <a href="." style="text-decoration:none;"><p id="text-logo">STAR WARS RP NGG</p></a>
        </div>
        <div class="drop-server">
        	<a class="btn-head">SWRP Phase 1<img src="img/chev.svg" class="chev" /></a>
        	<div class="drop-cont">
        		<a href="swrp1">Игроки Phase 1</a>
        		<a href="top-online?phase=1">Топ онлайн Phase 1</a>
        	</div>
        </div>
        <div class="drop-server">
        	<a class="btn-head">SWRP Phase 2<img src="img/chev.svg" class="chev"/></a>
        	<div class="drop-cont">
        		<a href="swrp2">Игроки Phase 2</a>
        		<a href="top-online?phase=2">Топ онлайн Phase 2</a>
        	</div>
        </div>
        <?php 
        	if(isset($_SESSION['logged_user'])) {
        		$a = " | ";
        		echo '<a href ="profile" class ="reg-head" style="border:2px dotted #00748e;">'. $_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name. '</a>';
        		echo '<a href ="logout" class ="reg-logout"> Выйти </a>';
        	} else {
        		echo '<a href="login" class="reg-head">Войти</a>';
        		echo '<a href="signup" class="reg-head">Зарегистрироваться</a>';
        	}
    	?>
    </div>
</header>