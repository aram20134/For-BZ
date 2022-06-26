<?php

set_time_limit(30);
date_default_timezone_set('Europe/Moscow');

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

foreach ($result['players'] as $player) {
	if ($player['name'] == NULL) {
		die();
	}
	break;
}
foreach ($result2['players'] as $player) {
	if ($player['name'] == NULL) {
		die();
	}
	break;
}

function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

if (true) {
    $off = array();
    $players_last = array();
    $pl_last = R::getAll('SELECT * FROM bufonl WHERE phase = 1'); // Игроки минуту назад
    $pl_now = array();
    $pl_now = $result['players']; // Игроки сейчас
    $tt = array();
    $tt[] = ['name' => 'test'];
    array_unshift($pl_now, $tt);
        foreach ($result['bots'] as $bots) {
            $pl_now[] = ['name' => $bots['name']];
        }
    foreach ($pl_last as $pl_l)
    if ((recursive_array_search($pl_l['name'], $pl_now))) {
        $id = recursive_array_search($pl_l['name'], $pl_now);
        unset($pl_now[$id]);
    } else {
        $off[] = ['name' => $pl_l['name']];
    }
    foreach($pl_now as $pl) { // Зашёл
        if ($pl['name'] != NULL and $pl['name'] != 'test') {
			$logs = R::dispense('logs');
			$logs->name = $pl['name'];
			$logs->status = 'Enter';
			$logs->phase = '1';
			$logs->date = date("Y-m-d H:i:s");
			R::store($logs);
		}
    }
    foreach ($off as $off_one) { // Вышел
		$delbuf = R::findOne('bufonl', 'name = :n AND phase = :ph', [':n' => $off_one['name'], ':ph' => '1']);
        if ($delbuf != NULL) {
			R::trash($delbuf);
		}
		if ($off_one['name'] != NULL and $off_one['name'] != 'first') {
			$logs = R::dispense('logs');
			$logs->name = $off_one['name'];
			$logs->status = 'Exit';
			$logs->phase = '1';
			$logs->date = date("Y-m-d H:i:s");
			R::store($logs);
		}
    }
} 
if (true) {
    $off = array();
    $players_last = array();
    $pl_last = R::getAll('SELECT * FROM bufonl WHERE phase = 2'); // Игроки минуту назад
    $pl_now = array();
    $pl_now = $result2['players']; // Игроки сейчас
    $tt = array();
    $tt[] = ['name' => 'test'];
    array_unshift($pl_now, $tt);
        foreach ($result2['bots'] as $bots) {
            $pl_now[] = ['name' => $bots['name']];
        }
    foreach ($pl_last as $pl_l)
    if ((recursive_array_search($pl_l['name'], $pl_now))) {
        $id = recursive_array_search($pl_l['name'], $pl_now);
        unset($pl_now[$id]);
    } else {
        $off[] = ['name' => $pl_l['name']];
    }
    foreach($pl_now as $pl) { // Зашёл
        if ($pl['name'] != NULL and $pl['name'] != 'test') {
			$logs = R::dispense('logs');
			$logs->name = $pl['name'];
			$logs->status = 'Enter';
			$logs->phase = '2';
			$logs->date = date("Y-m-d H:i:s");
			R::store($logs);
		}
    }
    foreach ($off as $off_one) { // Вышел
		$delbuf = R::findOne('bufonl', 'name = :n AND phase = :ph', [':n' => $off_one['name'], ':ph' => '2']);
        if ($delbuf != NULL) {
			R::trash($delbuf);
		}
		if ($off_one['name'] != NULL and $off_one['name'] != 'second') {
			$logs = R::dispense('logs');
			$logs->name = $off_one['name'];
			$logs->status = 'Exit';
			$logs->phase = '2';
			$logs->date = date("Y-m-d H:i:s");
			R::store($logs);
		}
    }
} 

$logs = R::getAssoc('SELECT * FROM logs');
$date2 = $logs[array_key_first($logs)];
$dateDiff2 = date_diff(new DateTime(), new DateTime($date2['date']))->days + 1;
if ($dateDiff2 > 3) {
	$a = strtotime($date2['date']);
	$datee = "%".date('Y', $a).'-'.date('m', $a).'-'.date('d', $a)."%";
	echo $datee;
	$logs = R::findAll('logs', 'date LIKE ?', [$datee]);
	print_r($logs);
	R::trashall($logs);
}


$online = R::getAssoc('SELECT * FROM online');
$date = $online[array_key_first($online)];
$dateDiff = date_diff(new DateTime(), new DateTime($date['y']."-".$date['m']."-".$date['d']))->days + 1;
	if ($dateDiff > 14) {
		$online = R::findAll('online', 'd = :d AND m = :m AND y = :y', [':d' => $date['d'], ':m' => $date['m'], ':y' => $date['y']]);
		$online2 = R::findAll('online2', 'd = :d AND m = :m AND y = :y', [':d' => $date['d'], ':m' => $date['m'], ':y' => $date['y']]);

		R::trashall($online2);
		R::trashall($online);
	}
	R::wipe('bufonl');
	$bufonl = R::dispense('bufonl');
	$bufonl->name = 'first';
	$bufonl->phase = 1;
	R::store($bufonl);
foreach($result['players'] as $player) {
	$bufonl = R::dispense('bufonl');
	$bufonl->name = $player['name'];
	$bufonl->phase = 1;
	R::store($bufonl);
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
	$bufonl = R::dispense('bufonl');
	$bufonl->name = 'second';
	$bufonl->phase = 2;
	R::store($bufonl);
foreach($result2['players'] as $player2) {
	$bufonl = R::dispense('bufonl');
	$bufonl->name = $player2['name'];
	$bufonl->phase = 2;
	R::store($bufonl);
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

foreach ($result['bots'] as $bots) {
	$bufonl = R::dispense('bufonl');
	$bufonl->name = $bots['name'];
	$bufonl->phase = 1;
	R::store($bufonl);
}
foreach ($result2['bots'] as $bots) {
	$bufonl = R::dispense('bufonl');
	$bufonl->name = $bots['name'];
	$bufonl->phase = 2;
	R::store($bufonl);

}

exit();