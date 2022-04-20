<?php
$url="http://83.234.136.125:3334/players2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result2=json_decode(curl_exec($ch), true);
curl_close($ch);
require '../db.php';
if ($result2['raw']['numplayers'] != NULL) {
    echo $result2['raw']['numplayers'].'/128';
} else {
    echo 'Offline';
}
foreach($result2['players'] as $player) {
	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $player['name'], ':ph' => "2"]);
	if ($player['name'] == $user['steamname'] and $user['phase'] == "2") {
		// echo '<a href="" class="find">';
		$a = " | ";
		$output = $user['number'].$a.$user['name'].$a.$user['legion'].$a.$user['rang'];
		
		// echo '</a>';
		
		if ($output == $user['number'].$a.$user['name'].$a."Без легиона".$a.$user['rang']) {
			$output = $user['number'].$a.$user['name'].$a.$user['rang'];
			echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
			echo $output;
			echo '</a>';
		} elseif ($output == $user['number'].$a.$user['name'].$a.$a or $output == $user['number'].$a.$user['name'].$a.$user['legion'].$a) {
			echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
			$output = $user['number']." | ".$user['name'];
			echo $output;
			echo '</a>';
		} else {
			echo '<a href="https://swrpngg.space/profile-other?'."number=".$user['number']."&phase=".$user['phase'].'" class="find">';
			echo $output;
			echo '</a>';
		}
	} else if ($player['name'] == "" or $player['name'] == "็") {
		
	} else {
		echo '<a href="https://swrpngg.space/profile-other?steam='.$player['name'].'" class ="none">';
		echo $player['name'];
		echo '</a>';
	} 
}
?>