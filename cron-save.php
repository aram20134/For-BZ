<?php

set_time_limit(30);

require "db.php";

// ПЕРВЫЙ СЕРВЕР
$url="http://83.234.136.125:3333/players";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);

// ВТОРОЙ СЕРВЕР
$url2="http://83.234.136.125:3334/players2";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);

$d = date("d");
$m = date("m");
$y = date("Y");

$online = R::getAssoc('SELECT * FROM online');
$date = $online[array_key_first($online)];
$dateDiff = date_diff(new DateTime(), new DateTime($date['y']."-".$date['m']."-".$date['d']))->days + 1;
	if ($dateDiff > 14) {
		$online = R::findAll('online', 'd = :d AND m = :m AND y = :y', [':d' => $date['d'], ':m' => $date['m'], ':y' => $date['y']]);
		$online2 = R::findAll('online2', 'd = :d AND m = :m AND y = :y', [':d' => $date['d'], ':m' => $date['m'], ':y' => $date['y']]);

		R::trashall($online2);
		R::trashall($online);
	}

foreach($result['players'] as $player) {
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
				if ($online['steamname'] == "᠌ ᠌ ᠌᠌ ᠌ ᠌ ᠌ ᠌" or $online['steamname'] == "" or $online['steamname'] == " " or $online['steamname'] == "็") {
					
				} else {
					R::store($online);
				}
}
foreach($result2['players'] as $player2) {
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
				if ($online2['steamname'] == "᠌ ᠌ ᠌᠌ ᠌ ᠌ ᠌ ᠌" or $online2['steamname'] == "" or $online2['steamname'] == " " or $online2['steamname'] == "็") {
					
				} else {
					R::store($online2);
				}
}

$bz1 = R::findOne('bz1', 'd = :d AND m = :m AND y = :y', [':d' => $d, ':m' => $m, ':y' => $y]);
$bz2 = R::findOne('bz2', 'd = :d AND m = :m AND y = :y', [':d' => $d, ':m' => $m, ':y' => $y]);

if ($bz1 == NULL) {
	$bz1 = R::dispense('bz1');
	$bz1->d = date("d");
	$bz1->m = date("m");
	$bz1->y = date("Y");
	$bz1->pick = $result['raw']['numplayers'];
    R::store($bz1);
}

if ($bz1['pick'] < $result['raw']['numplayers']) {
	$bz1->pick = $result['raw']['numplayers'];
    R::store($bz1);
}

if ($bz2 == NULL) {
	$bz2 = R::dispense('bz2');
	$bz2->d = date("d");
	$bz2->m = date("m");
	$bz2->y = date("Y");
	$bz2->pick = $result2['raw']['numplayers'];
    R::store($bz2);
}

if ($bz2['pick'] < $result2['raw']['numplayers']) {
	$bz2->pick = $result2['raw']['numplayers'];
    R::store($bz2);
}

exit();