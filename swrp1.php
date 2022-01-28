<?php
$title="[SWRP] Phase 1";
require "db.php";
require __DIR__ . '/header.php';

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
// MAPS
if ($result['map'] == "rp_anaxes_ngg_winter" or $result['map'] == "rp_anaxes_ngg") {
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
?>
<script src="jquery-3.6.0.min.js"></script>
<!--SCRYPT-->
    <script>
    $(document).ready(function () {
    	
    var map = '<?php echo $map ?>';
    
    var sim1 = '<?php echo $sim1 ?>';
    
    var gen1 = '<?php echo $gen1 ?>';
    
    var nabo1 = '<?php echo $nabo1 ?>';
    
    if (map == "Anaxes") {
    	$('.first').toggleClass('map-anaxes');
    } else if (map == "Tatooine" && sim1 == "1") {
    	$('.first').toggleClass('map-tatooine_sim'); 
    } else if (map == "Geonosis" && gen1 == "1") {
    	$('.first').toggleClass('map-geonosis2');
    } else if (map == "Naboo" && nabo1 == "1") {
    	$('.first').toggleClass('map-naboo2'); 
    } else if (map == "Korriban") {
    	$('.first').toggleClass('map-korriban');
    } else if (map == "Geonosis") {
    	$('.first').toggleClass('map-geonosis');
    } else if (map == "Tatooine") {
    	$('.first').toggleClass('map-tatooine'); 
    } else if (map == "Takodana") {
    	$('.first').toggleClass('map-takodana');
    } else if (map == "Naboo") {
    	$('.first').toggleClass('map-naboo');
    } else if (map == "Mygeeto") {
    	$('.first').toggleClass('map-mygeeto');
    }
});
    </script>
<?php 
$update= date("i", $result['date']/1000);
$update2 = date("i", $result2['date']/1000);
$today = date("i", time());
$diff=$today-$update;
$diff2= $today - $update2;
$d = date("d");
$m = date("m");
$y = date("y");
?>

<div class ="content">
	<p class="name-server">
        Русский StarWars Phase 1 | Быстрая загрузка
    </p>
    <div class="box-online first">
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
	<div class="alert-box">Информация о сервере обновляется каждые 15 минут</div>
	<h1>Игроки на сервере</h1>
	<div class ="players">
		
			<?php
			
			foreach($result['playerslist'] as $player) {
				$user = R::findOne('usersbz', 'steamname = ?', [$player['name']]);
				if ($player['name'] == $user['steamname'] and $user['phase'] == "1") {
					// echo '<a href="" class="find">';
					$a = " | ";
					$output = $user['number'].$a.$user['name'].$a.$user['legion'].$a.$user['rang'];
					
					// echo '</a>';
					
					if ($output == $user['number'].$a.$user['name'].$a."Без легиона".$a.$user['rang']) {
						$output = $user['number'].$a.$user['name'].$a.$user['rang'];
						echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
						echo $output;
						echo '</a>';
					} elseif ($output == $user['number'].$a.$user['name'].$a.$a) {
						echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
						$output = $user['number']." | ".$user['name'];
						echo $output;
						echo '</a>';
					} else {
						echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
						echo $output;
						echo '</a>';
					}
				} else if ($player['name'] == "") {
					
				} else {
					echo '<a href="https://swrpngg.space/profile-other?steam='.$player['name']."&phase=1".'" class ="none">';
					echo $player['name'];
					echo '</a>';
				}
			}
			
				
			?>
	</div>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>