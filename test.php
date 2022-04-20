<?php
$title = "test";
require __DIR__.'/header2.php';
?>
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
	<div style="color:white;">
		<?php
		R::wipe('bufonl');
		// R::trashall($tr);
		$bufonl = R::dispense('bufonl');
		$bufonl->player = $player['name'];
		$bufonl->phase = 1;
		R::store($bufonl);
		?>
	</div>
    
<?php 
require __DIR__ . '/footer.php'; 
?>

<!-- <?php
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
			?> -->

<!-- <?php
			foreach($result['players'] as $player) {
				$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $player['name'], ':ph' => "1"]);
				// $a = R::getAssoc(" SELECT * FROM usersbz WHERE steamname like '%".$player['name']."%' AND phase like '%1%' ");
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
				} else if ($player['name'] == NULL or $player['name'] == "" or $player['name'] == "" or $player['name'] == "็") {
					
				} else {
					echo '<a href="https://swrpngg.space/profile-other?steam='.$player['name']."&phase=1".'" class ="none">';
					echo $player['name'];
					echo '</a>';
				}
			}
			
			?> -->