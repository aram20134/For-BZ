<?php
$title = "test";
require __DIR__.'/header2.php';
?>
<script>
	$(document).ready(function () {
		$('input').keyup (function () {
			var filter = $('#fil').val();
			$.ajax ({
				url: './refs/getFilterPlayers.php',
				method: 'get',
				dataType: 'html',
				async: false,
				data: {filter: filter},
				success: function(data){
					$('#asd').html(data);
				}
			});
		});
	});
</script>
<!-- Чё смотришь? закрывай давай и уроки делать -->
<div class="content">
	<h1 style="color:white;font-size:24px;">Поиск игроков</h1>
	<input id="fil" type="text" placeholder="Никнейм или номер" />
	<!-- <input type="checkbox" name="phase1" checked />
	<label for="phase1">Phase 1</label>
	<input type="checkbox" name="phase2" checked />
	<label for="phase2">Phase 2</label> -->
	<div style="min-width:50%;" id="asd"></div>
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