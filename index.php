<?php
$title="[SWRP] Главная";
require __DIR__ . '/header2.php';
$bz1 = R::getAssoc('SELECT * FROM bz1');
$bz2 = R::getAssoc('SELECT * FROM bz2');
?>

<?php
// ПЕРВЫЙ СЕРВЕР
$url="http://83.234.136.125:3333/players";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);
// print_r($result);

?>

<?php
// ВТОРОЙ СЕРВЕР
$url2="http://83.234.136.125:3334/players2";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
curl_setopt($ch2, CURLOPT_TIMEOUT, 3);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);
 ?>
<?php
// MAPS
if ($result['map'] == "rp_anaxes_ngg_winter" or $result['map'] == "rp_anaxes_ngg") {
	$map = "Anaxes";
	$desc = "База";
} elseif ($result['map'] == "ngg_sw_m3") {
	$map = "Tatooine";
	$desc = "Симуляция сражения";
} elseif ($result['map'] == "ngg_sw_m12") {
	$map = "Takodana";
	$desc = "Превосходство";
} elseif ($result['map'] == "ngg_sw_m6") {
	$map = "Geonosis";
	$desc = "Контроль территорий";
} elseif ($result['map'] == "ngg_sw_m10") {
	$map = "Korriban";
	$desc = "Контроль территорий";
} elseif ($result['map'] == "ngg_sw_m11") {
	$map = "Naboo";
	$desc = "Симуляция сражения";
} elseif ($result['map'] == "ngg_sw_m4") {
	$map = "Tatooine";
	$sim1 = "1";
	$desc = "Цитадель";
} elseif ($result['map'] == "ngg_sw_m7") {
	$map = "Geonosis";
	$gen1 = "1";
	$desc = "Цитадель";
} elseif ($result['map'] == "ngg_sw_m5") {
	$map = "Naboo";
	$nabo1 = "1";
	$desc = "Превосходство";
} elseif ($result['map'] == "ngg_sw_m13") {
	$map = "Mygeeto";
	$desc = "Контроль территорий";
} else {
	$map = "Anaxes";
	$desc = "База";
}

if ($result2['map'] == "rp_corellia_ngg_winter" or $result2['map'] == "rp_corellia_ngg") {
	$map2 = "Corellia";
	$desc2 = "База";
} elseif ($result2['map'] == "ngg_sw_m3") {
	$map2 = "Tatooine";
	$desc2 = "Симуляция сражения";
} elseif ($result2['map'] == "ngg_sw_m12") {
	$map2 = "Takodana";
	$desc2 = "Превосходство";
} elseif ($result2['map'] == "ngg_sw_m6") {
	$map2 = "Geonosis";
	$desc2 = "Контроль территорий";
} elseif ($result2['map'] == "ngg_sw_m10") {
	$map2 = "Korriban";
	$desc2 = "Контроль территорий";
} elseif ($result2['map'] == "ngg_sw_m11") {
	$map2 = "Naboo";
	$desc2 = "Симуляция сражения";
} elseif ($result2['map'] == "ngg_sw_m4") {
	$map2 = "Tatooine";
	$desc2 = "Цитадель";
	$sim2 = "1";
} elseif ($result2['map'] == "ngg_sw_m7") {
	$map2 = "Geonosis";
	$desc2 = "Цитадель";
	$gen2 = "1";
} elseif ($result2['map'] == "ngg_sw_m5") {
	$map2 = "Naboo";
	$desc2 = "Превосходство";
	$nabo2 = "1";
} elseif ($result2['map'] == "ngg_sw_m13") {
	$map2 = "Mygeeto";
	$desc2 = "Контроль территорий";
} else {
	$map2 = "Corellia";
	$desc2 = "База";
}
?>
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<!-- <script>
		function show () {
			$.ajax ({
				url: 'https://swrpngg.space/api/getplayers',
				method: 'get',
				dataType: 'json',
				cache: false,
				success: function(data) {
					document.getElementById('onl').innerHTML = data['raw']['numplayers'] + "/128";
				}
			});
		}
		function show2 () {
			$.ajax ({
				url: 'https://swrpngg.space/api/getplayers2',
				method: 'get',
				dataType: 'json',
				cache: false,
				success: function(data) {
					document.getElementById('onl2').innerHTML = data['raw']['numplayers'] + "/128";
				}
			});
		}
                		$(document).ready(function() {
							show();
							setInterval('show()', 10000);
						});
                		$(document).ready(function() {
							show2();
							setInterval('show2()', 10000);
						});
</script> -->
<!--SCRYPT-->
    <script>
    var map =  '<?php echo $map ?>';
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
<!--SCRYPT-->
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
    <div class="content">
		<!-- <div class="alert-box">
			САЙТ НА ДАННЫЙ МОМЕНТ НЕ РАБОТАЕТ!!!
		</div> -->
        <div class="menu-content">
            <h3>Добро пожаловать!</h3>
            <p>Сайт неофициально связан с проектами SWRP NGG. Главной его функцией является отображение статуса серверов, игроков на сервере и их онлайн. Регистрация позволит выводить ваше НПЗ вместо ника в стиме. Все данные обновляются в реальном времени.
                
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
                <div class="text-online1">
                	<img src="img/planet5.png" class="ico">
                	<div class = "maps">
                		<div class = "m"><?php echo $map; ?></div>
                		<div><?php echo $desc; ?></div>
                	</div>
                </div>
                <div class="text-online1">
                	<img src="img/phase1/clone1.png" class="ico2">
                	<div id="onl"></div>
                	<?php 
                	if ($result['raw']['numplayers'] != NULL) {
                		echo $result['raw']['numplayers']."/128"; 
                	} else {
                		echo 'Offline';
                	}
                	?>
                </div>
				<?php 
					if ($result['raw']['numplayers'] != NULL) {
						echo '<div id="difftime"></div>';
					} else {
						echo '<div id="difftime" style="background-color:red;"></div>';
					}
				?>
            </div>
            </a>
            <p class="name-server">
                Русский StarWars Phase 2 | Быстрая загрузка
            </p>
            <a href="swrp2" style="display:inherit;width:100%;justify-content:center;">
            <div class="box-online second">
                <div class="description">ПОДРОБНЕЕ</div>
                <div class="text-online2">
                	<img src="img/planet3.png" class="ico">
                	<div class = "maps">
                		<div class = "m"><?php echo $map2; ?></div>
                		<div><?php echo $desc2; ?></div>
                	</div>
                </div>
            	<div class="text-online2">
                	<img src="img/phase2/clone2.png" class="ico2">
                	<div id="onl2"></div>
                	<?php 
                	if ($result2['raw']['numplayers'] != NULL) {
                		echo $result2['raw']['numplayers']."/128"; 
                	} else {
                		echo 'Offline';
                	}
                	?>
                </div>
                <?php 
					if ($result2['raw']['numplayers'] != NULL) {
						echo '<div id="difftime"></div>';
					} else {
						echo '<div id="difftime" style="background-color:red;"></div>';
					}
				?>
            </div>
            </a>
        </div>
    </div>
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
<?php 
require __DIR__ . '/footer.php'; 
?>