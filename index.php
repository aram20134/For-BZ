<?php
$title="[SWRP] Главная";
require __DIR__ . '/header.php';
require "db.php";
?>
<?php
    $serverid = "7448";

$url="https://api.trackyserver.com/widget/index.php?id=".$server_id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);
 ?>
    <div class="online-log">
        <div class="box-online first map-anaxes">
            <div class="text-ivent">
                <!-- Карта: <script type='text/javascript'>document.write(api.mapname);</script>  -->
                <?php echo $result['playerscount']; ?>
            </div>
            <div class="text-online">
                <!-- <script type='text/javascript'>document.write(api.players +' / '+ api.maxplayers);</script>  -->
            </div>
        </div>  
        <div class="box-online second map-corelia">
            
        </div>
    </div>
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
    </div>
<?php 
require __DIR__ . '/footer.php'; 
?>