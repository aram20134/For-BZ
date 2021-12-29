<?php
$title="[SWRP] Главная";
require __DIR__ . '/header.php';
require "db.php";
?>
<?php
    $serverid = "7448";

$url="https://api.trackyserver.com/widget/index.php?id=7448";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);
 ?>
 <?php
	$serverid = "660455";

$url2="https://api.trackyserver.com/widget/index.php?id=660455";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);
 ?>
    <div class="content">
        <div class="head-logo">
            
            <!-- <a href="#" id="btn-logo"></a> -->
            <p id="text-logo">STAR WARS RP NGG</p>
            <!-- <a href="#" id="btn-logo"></a> -->
        </div>
        <div class="menu-content">
            <h3>Добро пожаловать!</h3>
            <p>Это эксперементальная версия сайта, неофициально связанная с проектами SWRP NGG. Данный сайт представляет из себя комплекс взаимосвязанных фреймворков, позволяющих в будущем сделать сайт многофункциональным центром. На данный момент сайту выделен уклон на первый сервер и реализацию небольшой игры, аналога игры динозавра с гугл хрома.
                <br><br>
                Если у вас есть вопросы, предложения или вы нашли баг, обратитесь к Fish'у #3493.
            </p>
        </div>
        <h1 class="online-head">СТАТУС СЕРВЕРОВ</h1>
        <div class="online-log">
            <div class="box-online first map-anaxes">
                <div class="text-online">
                	<?php echo $result['playerscount']; ?>
                </div>
            </div>  
            <div class="box-online second map-corelia">
            	<div class="text-online">
                	<?php echo $result2['playerscount']; ?>
                </div>
            </div>
        </div>
    </div>
<?php 
require __DIR__ . '/footer.php'; 
?>