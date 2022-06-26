<?php
$title="[SWRP] Phase 1";
require __DIR__ . '/header2.php';
$bz1 = R::getAssoc('SELECT * FROM bz1');
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
// print_r($result['players']);	
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
	$desc = "Цитадель";
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
	$desc = "Контроль территорий";
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
?>
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<!-- <script>

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

<div class ="content">
	<p class="name-server">
        Русский StarWars Phase 1 | Быстрая загрузка
    </p>
    <div class="box-online first">
        <div class="text-online1">
        	<img src="img/planet5.png" class="ico">
        	<div class = "maps">
        		<div class = "m"><?php echo $map; ?></div>
        		<div><?php echo $desc; ?></div>
        	</div>
        </div>
        <div class="text-online1">
        	<img src="img/phase1/clone1.png" class="ico2">
        	<div id ="onl">
        	<?php 
                	if ($result['raw']['numplayers'] != NULL) {
                		echo $result['raw']['numplayers']."/128"; 
                	} else {
                		echo 'Offline';
                	}
    		?>
			</div>
        </div>
        <?php 
			if ($result['raw']['numplayers'] != NULL) {
				echo '<div id="difftime"></div>';
			} else {
				echo '<div id="difftime" style="background-color:red;"></div>';
			}
		?>
	</div>
	<h1>Игроки на сервере</h1>
	<div class ="players">
	<script>
        var pl;
        var players;
        function getplayers () {
            $.ajax({
                url: './refs/getplayers.php',
                method: 'get',
                dataType: 'html',
                async: false,
                data: {type: ''},
                success: function(data){
                    players = data.search('<');
                    pl = data.slice(players);
                    pl.slice(players);
                    players = data.slice(0, players);
                    $('#onl').html(players);
                    $('.players').html(pl);
                    setTimeout(getplayers, 5000);
                }
            });
        }
        getplayers();
    </script>
	</div>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>