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
    
    var _0xe064=["\x41\x6E\x61\x78\x65\x73","\x6D\x61\x70\x2D\x61\x6E\x61\x78\x65\x73","\x74\x6F\x67\x67\x6C\x65\x43\x6C\x61\x73\x73","\x2E\x66\x69\x72\x73\x74","\x54\x61\x74\x6F\x6F\x69\x6E\x65","\x31","\x6D\x61\x70\x2D\x74\x61\x74\x6F\x6F\x69\x6E\x65\x5F\x73\x69\x6D","\x47\x65\x6F\x6E\x6F\x73\x69\x73","\x6D\x61\x70\x2D\x67\x65\x6F\x6E\x6F\x73\x69\x73\x32","\x4E\x61\x62\x6F\x6F","\x6D\x61\x70\x2D\x6E\x61\x62\x6F\x6F\x32","\x4B\x6F\x72\x72\x69\x62\x61\x6E","\x6D\x61\x70\x2D\x6B\x6F\x72\x72\x69\x62\x61\x6E","\x6D\x61\x70\x2D\x67\x65\x6F\x6E\x6F\x73\x69\x73","\x6D\x61\x70\x2D\x74\x61\x74\x6F\x6F\x69\x6E\x65","\x54\x61\x6B\x6F\x64\x61\x6E\x61","\x6D\x61\x70\x2D\x74\x61\x6B\x6F\x64\x61\x6E\x61","\x6D\x61\x70\x2D\x6E\x61\x62\x6F\x6F","\x4D\x79\x67\x65\x65\x74\x6F","\x6D\x61\x70\x2D\x6D\x79\x67\x65\x65\x74\x6F"];if(map== _0xe064[0]){$(_0xe064[3])[_0xe064[2]](_0xe064[1])}else {if(map== _0xe064[4]&& sim1== _0xe064[5]){$(_0xe064[3])[_0xe064[2]](_0xe064[6])}else {if(map== _0xe064[7]&& gen1== _0xe064[5]){$(_0xe064[3])[_0xe064[2]](_0xe064[8])}else {if(map== _0xe064[9]&& nabo1== _0xe064[5]){$(_0xe064[3])[_0xe064[2]](_0xe064[10])}else {if(map== _0xe064[11]){$(_0xe064[3])[_0xe064[2]](_0xe064[12])}else {if(map== _0xe064[7]){$(_0xe064[3])[_0xe064[2]](_0xe064[13])}else {if(map== _0xe064[4]){$(_0xe064[3])[_0xe064[2]](_0xe064[14])}else {if(map== _0xe064[15]){$(_0xe064[3])[_0xe064[2]](_0xe064[16])}else {if(map== _0xe064[9]){$(_0xe064[3])[_0xe064[2]](_0xe064[17])}else {if(map== _0xe064[18]){$(_0xe064[3])[_0xe064[2]](_0xe064[19])}}}}}}}}}}
});
    </script>
<?php 

$cur = date("Y:m:d H:i:s");
$acur = new DateTime($cur);

$last = date("Y:m:d H:i:s", $result['date']/1000);
$alast = new DateTime($last);

$last2 = date("Y:m:d H:i:s", $result2['date']/1000);
$alast2 = new DateTime($last2);

$diff = $acur->diff($alast);
$diff2 = $acur->diff($alast2);

$diff = $diff->format("%i");
$diff2 = $diff2->format("%i");
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
				} else if ($player['name'] == NULL or $player['name'] == "" or $player['name'] == "" or $player['name'] == "็") {
					
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