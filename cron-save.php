<?php
$title="Save BD";
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
// ВТОРОЙ СЕРВЕР
$url2="https://api.trackyserver.com/widget/index.php?id=660455";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);
?>
<?php 
$update= date("i", $result['date']/1000);
$update2 = date("i", $result2['date']/1000);
$today = date("i", time());
$diff=$today-$update;
$diff2= $today - $update2;
$d = date("d");
$m = date("m");
$y = date("Y");
?>


<?php
foreach($result['playerslist'] as $player) {
				$online = R::findOne('online', 'd = :d AND m = :m AND y = :y AND steamname = :st', [':d' => $d, ':m' => $m, ':y' => $y, ':st'=>$player['name']]);
				if ($online != NULL) {
					$online->time = $online['time'] + 1;
				} else {
					$online = R::dispense('online');
					$online->steamname = $player['name'];
					$online->d = $d;
					$online->m = $m;
					$online->y = $y;
					$online->time = 1;	
				}
				if ($online['steamname'] == "" or $online['steamname'] == " " or $online['steamname'] == "็") {
					
				} else {
					R::store($online);
				}
}
foreach($result2['playerslist'] as $player2) {
				$online2 = R::findOne('online2', 'd = :d AND m = :m AND y = :y AND steamname = :st', [':d' => $d, ':m' => $m, ':y' => $y, ':st'=>$player2['name']]);
				if ($online2 != NULL) {
					$online2->time = $online2['time'] + 1;
				} else {
					$online2 = R::dispense('online2');
					$online2->steamname = $player2['name'];
					$online2->d = $d;
					$online2->m = $m;
					$online2->y = $y;
					$online2->time = 1;	
				}
				if ($online2['steamname'] == "" or $online2['steamname'] == " " or $online2['steamname'] == "็") {
					
				} else {
					R::store($online2);
				}
}

?>





<?php 
require __DIR__ . '/footer.php'; 
?>