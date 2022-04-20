<?php
$data = $_GET;
if ($data['phase'] == 1 or $data['phase'] == 2) {
	$title="[SWRP] Топ онлайн Phase ".$data['phase'];
} else {
	$title = "[SWRP] Ошибка";	
}
require __DIR__ . '/header2.php';
?>
<?php
	if ($data['phase'] == '1') {
		$online = R::getAssoc('SELECT * FROM online');
	} else {
		$online = R::getAssoc('SELECT * FROM online2');
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
	$steam = array();
	$steam[] = 'hasdqwe';
	$top50 = array();
	$itog = array();
	$itog[] = ["time" => '1', "steamname" => 'hasdqwe'];
	foreach ($online as $_arr) {
		if (recursive_array_search($_arr['steamname'], $steam) == true) {
			$id = recursive_array_search($_arr['steamname'], $steam);
			$itog[$id]['time'] += $_arr['time'];
		} else {
			$steam[] = $_arr['steamname'];
			$itog[] = ["time" => $_arr['time'], "steamname" => $_arr['steamname']];
		}
	}
	arsort($itog);
	$top50 = array_slice($itog, 0, 50);
?>
<?php 
	$date = $online[array_key_first($online)];
	$dateDiff = date_diff(new DateTime(), new DateTime($date['y']."-".$date['m']."-".$date['d']))->days + 1;
?>
<!-- 
	<?php print_r($itog); ?>
 -->
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
	// [Date.UTC(2022, 0, 21), 100],
var chart = Highcharts.chart('container', {
    chart: {
        type: 'column',
        backgroundColor: 'transparent',
        width:1200,
    },
    title: {
        text: 'Топ 5 онлайна Phase <?php echo $data['phase'] ?> за <?php 
			if ($dateDiff < 5) {
				echo $dateDiff." Дня";
			} else {
				echo $dateDiff." Дней";
			}
		?>',
        style: {
        	color: 'white',
        	fontWeight: 'bold',
        	fontSize: '25px',
        },
    },
    credits: {
		enabled: false
	},
    xAxis: {
        type:'category',
        labels: {
        	style: {
    			color: 'white',
    			fontSize:'15px',
    		},
        }
    },
    yAxis: {
        title: {
            text: 'Онлайн (минуты)',
            style: {
        		color: 'white',
        		fontWeight: 'bold',
        		fontSize:'20px'
        	},
        },
        labels: {
        	style: {
        	color: 'white'
        	}
		},
    },
    legend: {
        enabled: false
    },
    
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{y} м'
            }
        }
    },

    series: [
        {
            name: "Минуты",
            colorByPoint: true,
            data: [
                { 
                    name: "<?php
                    	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[0]['steamname'], ':ph' => $data['phase']]);
                    	if ($user == NULL) {
                    		echo $top50[0]['steamname'];
                    	} else {
                    		echo $user['number']." | ".$user['name'];
                    	}
                    ?>",
                    y: <?php echo $top50[0]['time']; ?>,
                    color: 'gold',
                },
                {
                    name: "<?php
                    	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[1]['steamname'], ':ph' => $data['phase']]);
                    	if ($user == NULL) {
                    		echo $top50[1]['steamname'];
                    	} else {
                    		echo $user['number']." | ".$user['name'];
                    	}
                    ?>",
                    y: <?php echo $top50[1]['time']; ?>,
                    color: 'silver',
                },
                {
                    name: "<?php
                    	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[2]['steamname'], ':ph' => $data['phase']]);
                    	if ($user == NULL) {
                    		echo $top50[2]['steamname'];
                    	} else {
                    		echo $user['number']." | ".$user['name'];
                    	}
                    ?>",
                    y: <?php echo $top50[2]['time']; ?>,
                    color: '#cd7f32',
                },
                {
                    name: "<?php
                    	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[3]['steamname'], ':ph' => $data['phase']]);
                    	if ($user == NULL) {
                    		echo $top50[3]['steamname'];
                    	} else {
                    		echo $user['number']." | ".$user['name'];
                    	}
                    ?>",
                    y: <?php echo $top50[3]['time']; ?>,
                    color: 'mediumblue',
                },
                {
                    name: "<?php
                    	$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[4]['steamname'], ':ph' => $data['phase']]);
                    	if ($user == NULL) {
                    		echo $top50[4]['steamname'];
                    	} else {
                    		echo $user['number']." | ".$user['name'];
                    	}
                    ?>",
                    y: <?php echo $top50[4]['time']; ?>,
                    color: 'mediumblue',
                }
            ]
        }
    ]
});
	if (window.matchMedia("(min-width: 1200px)").matches) {
    	
	} else {
		chart.setSize(1000);
	}
    if (window.matchMedia("(min-width: 1024px)").matches) {
    	
	} else {
		chart.setSize(800);
	}
    if (window.matchMedia("(min-width: 800px)").matches) {
    	
    } else {
    	chart.setSize(600);
    }
    if (window.matchMedia("(min-width: 600px)").matches) {
    	
    } else {
    	chart.setSize(document.documentElement.clientWidth);
    }
    });
</script>

<div class ="content">
	<?php if($data['phase'] == "1" or $data['phase'] == "2") : ?>
		<figure class="highcharts-figure">
			<div id="container"></div>
			<div style="display:flex;justify-content:center;">
			</div>
		</figure>
	<h1 style="margin-top:70px;text-align:center;">Топ 50 онлайна Phase <?php echo $data['phase'] ?> за 
	<?php 
			if ($dateDiff < 5) {
				echo $dateDiff." Дня";
			} else {
				echo $dateDiff." Дней";
			}
	?>
	</h1>
	<div class="top-players">
		<div class ="pl" style="border:2px solid white;border-radius:15px;">
			<div class="num-td">Место</div>
			<div class="pl-td" style="color:white;" >Ник (НПЗ)</div>
			<div class="time-td">Время (м)</div>
		</div>
		<?php 
			for($i = 0; $i < 50; $i++) {
				$n = $i + 1;
				// $online = R::findOne('online', 'd = :d AND m = :m AND y = :y AND steamname = :st', [':d' => $d, ':m' => $m, ':y' => $y, ':st'=>$player['name']]);
				$user = R::findOne('usersbz', 'steamname = :st AND phase = :ph', [':st' => $top50[$i]['steamname'], ':ph' => $data['phase']]);
				echo '<div class="pl">';
				if ($n == 1) {
					echo '<div class="num-td" style="background:#ffd700;color:black;">' .$n.". ". '</div>';
				} else if ($n == 2) {
					echo '<div class="num-td" style="background:silver;color:black;">' .$n.". ". '</div>';
				} else if ($n == 3) {
					echo '<div class="num-td" style="background:#cd7f32;color:black;">' .$n.". ". '</div>';
				} else {
					echo '<div class="num-td">' .$n.". ". '</div>';
				}
				
				if ($user == NULL) {
					echo '<a href="profile-other?steam='.$top50[$i]['steamname']."&phase=".$data['phase'].'" class="pl-td">'.$top50[$i]['steamname']. '</a>';
				} else {
					echo '<a href="profile-other?number='.$user['number']."&phase=".$user['phase'].'" class="pl-tdf">'.$user['number']." | ".$user['name']." | ".$user['rang']. '</a>';
				}
				echo '<div class="time-td">'.$top50[$i]['time']. '</div>';
				echo '</div>';
			}
			
		?>
	</div>
	<?php else : ?>
	
	<div class="alert-box">Информация не найдена</div>
	
	<?php endif ?>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>