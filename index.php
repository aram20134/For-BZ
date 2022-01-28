<?php
$title="[SWRP] Главная";
require "db.php";
require __DIR__ . '/header.php'
?>

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
} elseif ($result['map'] == "ngg_sw_m11") {
	$map = "Naboo";
} elseif ($result['map'] == "ngg_sw_m4") {
	$map = "Tatooine";
	$sim1 = "1";
} elseif ($result['map'] == "ngg_sw_m7") {
	$map = "Geonosis";
	$gen1 = "1";
} elseif ($result['map'] == "ngg_sw_m5") {
	$map = "Naboo";
	$nabo1 = "1";
} elseif ($result['map'] == "ngg_sw_m13") {
	$map = "Mygeeto";
} else {
	$map = "Anaxes";
}
if ($result2['map'] == "rp_corellia_ngg_winter") {
	$map2 = "Corellia";
} elseif ($result2['map'] == "ngg_sw_m3") {
	$map2 = "Tatooine";
} elseif ($result2['map'] == "ngg_sw_m12") {
	$map2 = "Takodana";
} elseif ($result2['map'] == "ngg_sw_m6") {
	$map2 = "Geonosis";
} elseif ($result2['map'] == "ngg_sw_m10") {
	$map2 = "Korriban";
} elseif ($result2['map'] == "ngg_sw_m11") {
	$map2 = "Naboo";
} elseif ($result2['map'] == "ngg_sw_m4") {
	$map2 = "Tatooine";
	$sim2 = "1";
} elseif ($result2['map'] == "ngg_sw_m7") {
	$map2 = "Geonosis";
	$gen2 = "1";
} elseif ($result2['map'] == "ngg_sw_m5") {
	$map2 = "Naboo";
	$nabo2 = "1";
} elseif ($result2['map'] == "ngg_sw_m13") {
	$map2 = "Mygeeto";
} else {
	$map2 = "Corellia";
}
?>
 <script src="jquery-3.6.0.min.js"></script>
<!--SCRYPT-->
    <script>
    var map = '<?php echo $map ?>';
    var map2 = '<?php echo $map2 ?>';
    
    var sim1 = '<?php echo $sim1 ?>';
    var sim2 = '<?php echo $sim2 ?>';
    
    var gen1 = '<?php echo $gen1 ?>';
    var gen2 = '<?php echo $gen2 ?>';
    
    var nabo1 = '<?php echo $nabo1 ?>';
    var nabo2 = '<?php echo $nabo2 ?>';
    $(document).ready(function(){$(".first").hover(function(){$(this).hasClass("active-server")||$(this).toggleClass("box-online-hover")});$(".second").hover(function(){$(this).hasClass("active-server")||$(this).toggleClass("box-online-hover")});"Anaxes"==map?$(".first").toggleClass("map-anaxes"):"Tatooine"==map&&"1"==sim1?$(".first").toggleClass("map-tatooine_sim"):"Geonosis"==map&&"1"==gen1?$(".first").toggleClass("map-geonosis2"):"Naboo"==map&&"1"==nabo1?$(".first").toggleClass("map-naboo2"):"Korriban"==
map?$(".first").toggleClass("map-korriban"):"Geonosis"==map?$(".first").toggleClass("map-geonosis"):"Tatooine"==map?$(".first").toggleClass("map-tatooine"):"Takodana"==map?$(".first").toggleClass("map-takodana"):"Naboo"==map?$(".first").toggleClass("map-naboo"):"Mygeeto"==map&&$(".first").toggleClass("map-naboo");"Corellia"==map2?$(".second").toggleClass("map-corellia"):"Tatooine"==map2&&"1"==sim2?$(".second").toggleClass("map-tatooine_sim"):"Geonosis"==map2&&"1"==gen2?$(".second").toggleClass("map-geonosis2"):
"Naboo"==map2&&"1"==nabo1?$(".second").toggleClass("map-naboo2"):"Korriban"==map2?$(".second").toggleClass("map-korriban"):"Naboo"==map2?$(".second").toggleClass("map-naboo"):"Tatooine"==map2?$(".second").toggleClass("map-tatooine"):"Takodana"==map2?$(".second").toggleClass("map-takodana"):"Geonosis"==map2?$(".second").toggleClass("map-geonosis"):"Mygeeto"==map2&&$(".second").toggleClass("map-mygeeto")});
    </script>
<?php 
$update= date("i", $result['date']/1000);
$update2 = date("i", $result2['date']/1000);
$today = date("i", time());
$diff= $today - $update;
$diff2= $today - $update2;
// Maybe Carbon? 
?>
<!--SCRYPT-->
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
    <div class="content">

        <div class="menu-content">
            <h3>Добро пожаловать!</h3>
            <p>Это эксперементальная версия сайта, неофициально связанная с проектами SWRP NGG. Главной его функцией является отображение статуса серверов, игроков на сервере и их онлайн. Регистрация позволит выводить ваше НПЗ вместо ника в стиме. 
                <br><br>
                Если у вас есть вопросы, предложения или вы нашли баг, обратитесь к Fish'у #3493.
            </p>
        </div>
        <h1 class="online-head">СТАТУС СЕРВЕРОВ</h1>
        <div class="online-log">
        	<p class="name-server">
                Русский StarWars Phase 1 | Быстрая загрузка
            </p>
            <a href="swrp1" style="display:inherit;width:100%;justify-content:center;">
            <div class="box-online first">
                <div class="description">ПОДРОБНЕЕ</div>
                <!--<div class="desc-content1 not-active">-->
                <!--    Карта: <?php echo $map; ?> <br>-->
                <!--    Кол-во игроков: <?php echo $result['playerscount']; ?>-->
                <!--</div>-->
                <div class="text-online1">
                	<img src="img/planet5.png" class="ico"><?php echo $map; ?>
                </div>
                <div class="text-online1">
                	<img src="img/phase1/clone1.png" class="ico2"><?php echo $result['playerscount']; ?>
                </div>
                <div class="difftime">
                	Последнее обновление - 
                	<?php 
                	if ($diff == "0") {
                		echo "Только что";
                	} else if ($diff == "1") {
                		echo $diff;
                		echo " минуту назад";
                	} else if ($diff == "2" or $diff == "3" or $diff == "4") {
                		echo $diff;
                		echo " минуты назад";
                	} else if ($diff < 0) {
                		echo "Недавно";
                	} else {
                		echo $diff;
                		echo " минут назад";
                	}
                	?> 
                </div>
            </div>
            </a>
            <p class="name-server">
                Русский StarWars Phase 2 | Быстрая загрузка
            </p>
            <a href="swrp2" style="display:inherit;width:100%;justify-content:center;">
            <div class="box-online second">
                <div class="description">ПОДРОБНЕЕ</div>
                <!--<div class="desc-content2 not-active">-->
                <!--    Карта: <?php echo $result2['map']; ?> <br>-->
                <!--    Кол-во игроков: <?php echo $result2['playerscount']; ?> <br>-->
                <!--</div>-->
                <div class="text-online2">
                	<img src="img/planet3.png" class="ico"><?php echo $map2; ?>
                </div>
            	<div class="text-online2">
                	<img src="img/phase2/clone2.png" class="ico2"><?php echo $result2['playerscount']; ?>
                </div>
                <div class="difftime">
                	Последнее обновление - 
                	<?php 
                	if ($diff2 == "0") {
                		echo "Только что";
                	} else if ($diff2 == "1") {
                		echo $diff2;
                		echo " минуту назад";
                	} else if ($diff2 == "2" or $diff2 == "3" or $diff2 == "4") {
                		echo $diff2;
                		echo " минуты назад";
                	} else if ($diff2 < 0) {
                		echo "Недавно";
                	} else {
                		echo $diff2;
                		echo " минут назад";
                	}
                	?> 
                </div>
            </div>
            </a>
        </div>
    </div>
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
<?php 
require __DIR__ . '/footer.php'; 
?>