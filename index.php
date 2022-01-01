<?php
$title="[SWRP] Главная"; // название формы
require __DIR__ . '/header.php'; // подключаем шапку проекта
require "db.php"; // подключаем файл для соединения с БД
?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(87038010, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/87038010" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php
// ПЕРВЫЙ СЕРВЕР
$url="https://api.trackyserver.com/widget/index.php?id=7448";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);
 ?>
 
<?php
// ВТОРОЙ СЕРВЕР
$url2="https://api.trackyserver.com/widget/index.php?id=660455";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);
 ?>
<?php
// MAPS
if ($result['map'] == "rp_anaxes_ngg_winter") {
	$map = "Anaxes";
} elseif ($result['map'] == "ngg_sw_m3") {
	$map = "Tatooine";
} elseif ($result['map'] == "ngg_sw_m12") {
	$map = "Takodana";
} elseif ($result['map'] == "ngg_sw_m6") {
	$map = "Geonosis";
} elseif ($result['map'] == "ngg_sw_m10") {
	$map = "Korriban";
} else {
	$map = "Map not detected";
}

if ($result2['map'] == "rp_corellia_ngg_winter") {
	$map2 = "Corellia";
} else {
	$map2 = "Map not detected";
}
?>
 <script src="jquery-3.6.0.min.js"></script>
<!--SCRYPT-->
    <script>
    $(document).ready(function () {
    // $('.first').click(function () {
    //     $(this).toggleClass('active-server');
    //     $(this).toggleClass('box-online-hover');
    //     $('.text-online1').toggleClass('not-active');
    //     $('.desc-content1').toggleClass('not-active');
    // });
    	$('.first').hover(function () {
        	if(!$(this).hasClass('active-server')) {
            	$(this).toggleClass('box-online-hover');
        	}
    	});
    // $('.second').click(function () {
    //     $(this).toggleClass('active-server');
    //     $(this).toggleClass('box-online-hover');
    //     $('.text-online2').toggleClass('not-active');
    //     $('.desc-content2').toggleClass('not-active');
    // });
    	$('.second').hover(function () {
        	if(!$(this).hasClass('active-server')) {
    		$(this).toggleClass('box-online-hover');
        	}
    	});
    var map = '<?php echo $map ?>';
    var map2 = '<?php echo $map2 ?>';
    if (map == "Anaxes") {
    	$('.first').toggleClass('map-anaxes');
    } else if (map == "Tatooine") {
    	$('.first').toggleClass('map-tatooine');
    } else if (map == "Takodana") {
    	$('.first').toggleClass('map-takodana');
    } else if (map == "Geonosis") {
    	$('.first').toggleClass('map-geonosis');
    } else if (map == "Korriban"){
    	$('.first').toggleClass('map-korriban')
    }
    
    if (map2 == "Corellia") {
    	$('.second').toggleClass('map-corellia');
    } else {
    	
    }
});
    </script>
<!--SCRYPT-->
 <!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
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
        	<p class="name-server">
                Русский StarWars Phase 1 | Быстрая загрузка
            </p>
            <div class="box-online first">
                <div class="description">ПОДРОБНЕЕ</div>
                <!--<div class="desc-content1 not-active">-->
                <!--    Карта: <?php echo $map; ?> <br>-->
                <!--    Кол-во игроков: <?php echo $result['playerscount']; ?>-->
                <!--</div>-->
                <div class="text-online1">
                	<img src="img/planet.png" class="ico"><?php echo $map; ?>
                </div>
                <div class="text-online1">
                	<img src="img/CT/CT.png" class="ico"><?php echo $result['playerscount']; ?>
                </div>
            </div>  
            <p class="name-server">
                Русский StarWars Phase 2 | Быстрая загрузка
            </p>
            <div class="box-online second">
                <div class="description">ПОДРОБНЕЕ</div>
                <!--<div class="desc-content2 not-active">-->
                <!--    Карта: <?php echo $result2['map']; ?> <br>-->
                <!--    Кол-во игроков: <?php echo $result2['playerscount']; ?> <br>-->
                <!--</div>-->
                <div class="text-online2">
                	<img src="img/planet.png" class="ico"><?php echo $map2; ?>
                </div>
            	<div class="text-online2">
                	<img src="img/CT/CT.png" class="ico"><?php echo $result2['playerscount']; ?>
                </div>
            </div>
        </div>
    </div>
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
<?php 
require __DIR__ . '/footer.php'; 
?>