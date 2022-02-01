<?php
require "db.php";
$data = $_GET;
$user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $data['number'], ':ph' => $data['phase']]);
if ($user != NULL) {
	$title="[SWRP] Профиль игрока ".$user['name'];
} else {
	$title="[SWRP] Игрок ".$data['steam'];
}

require __DIR__ . '/header.php';
?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

<script src="jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
	var out = "<?php echo $user['number']." | ".$user['name']." | ".$user['rang'] ?>";
	var stm = "<?php echo $user['steamid'] ?>";
	function copyToClipboard() {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(out).select();
			document.execCommand("copy");
			$temp.remove();
			
		}
		function copyToClipboard2() {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(stm).select();
			document.execCommand("copy");
			$temp.remove();
		}
		
		$('#prof-btn').click(function() {
			copyToClipboard();
		});
		$('#prof-btn2').click(function() {
			copyToClipboard2();
		});
});
</script>
<script type="text/javascript">

<?php 
	
	if ($data['phase'] == "1") {
		$online = R::findAll('online', 'steamname = ?', [$data['steam']]);
		if ($online == NULL) {
			$online = R::findAll('online', 'steamname = ?', [$user['steamname']]);
		}
	} else {
		$online = R::findAll('online2', 'steamname = ?', [$data['steam']]);
		if ($online == NULL) {
			$online = R::findAll('online2', 'steamname = ?', [$user['steamname']]);
		}
	}
?>

document.addEventListener('DOMContentLoaded', function () {
	// [Date.UTC(2022, 0, 21), 100],
	
	var online = [
		<?php
		foreach ($online as $key => $value) {
			$value['m']--;
			echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['time'].'],';
		}
		?>
	];
Highcharts.setOptions({
    lang: {
            loading: 'Загрузка...',
            months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            weekdays: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            shortMonths: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
            exportButtonTitle: "Экспорт",
            printButtonTitle: "Печать",
            rangeSelectorFrom: "С",
            rangeSelectorTo: "По",
            rangeSelectorZoom: "Период",
            downloadPNG: 'Скачать PNG',
            downloadJPEG: 'Скачать JPEG',
            downloadPDF: 'Скачать PDF',
            downloadSVG: 'Скачать SVG',
            printChart: 'Напечатать график'   
        }        
});


    var chart = Highcharts.stockChart('container', {
    	
    	
    	chart: {
    		useHTML: true,
    		backgroundColor: 'transparent',
    		width: 1000,
    	},
    	navigator: {
    		enabled: false,
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
        	buttonSpacing: 2,
        	 buttons: [{
                    type: 'D',
                    count: 1,
                    text: 'Неделя'
                }, {
                    type: 'M',
                    count: 1,
                    text: 'Месяц'
                }, {
                    type: 'All',
                    text: 'Всё'
                }],
        	enabled: false,
        	allButtonsEnabled: true,
            selected: 2,
            buttonTheme: {
            	width: 50,
            	fill: 'none',
            	r: 8,
            	style: {
            		color: 'white',
                    fontWeight: 'bold'	
            	},
            	states: {
                    hover: {
                    	style : {
                    		color: 'black'	
                    	},
                    },
                    select: {
                        fill: '#039',
                        style: {
                            color: 'white'
                        }
                    }
                },
            },
            labelStyle: {
			color: 'white',
			fontWeight: 'bold'
			},
        },
		credits: {
    		enabled: false
		},
		
        title: {
            text: 'Онлайн <?php
            if ($user['number'] and $user['name'] != NULL) {
            	echo "[".$user['number']." | ".$user['name']."]";
            } else {
            	echo "[".$data['steam']."]";
            }
            ?>',
            style: {
            	color: 'white',
            	fontWeight: 'bold'
            },
        },
        yAxis: {
        	opposite: false,
            offset: 15,
            tickWidth: 1,
            tickLength: 10,
            lineWidth: 1,
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'15px'
        		}
			},
    	},
    	xAxis: {
        	title: {
            	style: {
        			color: 'white',
        			fontWeight: 'bold',
        		},
    	  },
    		labels: {
        		style: {
        		color: 'white',
        		fontSize:'13px'
        		}
			},
    	},
        responsive: {
        	rules: [{
        		condition: {
        			maxWidth:1000
        		},
        		chartOptions: {
        			
        		},
        	}]	
        },
    	plotOptions: {
        	series: {
            	borderWidth: 1,
            	color: 'red',
            	lineWidth: 4,
            	dataLabels: {
                	enabled: true,
                	format: '{y} м'
            	}
        	}
    	},
        series: [{
            name: 'Минуты',
            data: online,
            tooltip: {
                valueDecimals: 2,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 5,
                fillColor: 'blue',
                
            },
        }]
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
    	chart.setSize(320);
    }
    });
    
</script>
<div class ="content">
	<?php if($data == NULL or $steam == " ็") : ?>
	
	<div class ="alert-box">Страница не найдена</div>
	
	<?php else : ?>
		<?php $user = R::findOne('usersbz', 'number = :number AND phase = :phase', [':number' => $data['number'], ':phase' => $data['phase']]); ?>
		<?php if (isset($user)) : ?>
		<?php if($user['legion'] != NULL and $user['rang'] != NULL) : ?>
		<div class="profbz">
		<div class="profbz-content">
			<a href="<?php echo $user['profurl'] ?>"><img style="height:150px;" src="<?php echo $user['avatar']?>"  /></a>
			<?php echo '<div>'  ?>
			<?php echo '<div>'.$user['number']." | ".$user['name'].'</div>' ?>
			<?php echo '<div>'.$user['legion'].'</div>';  ?>
			<?php echo '<div>'.$user['rang'].'</div>';  ?>
			<?php echo '</div>'  ?>
		</div>
			<div class="prof-btns">
			<a href="<?php echo $user['profurl'] ?>" class="prof-btn">профиль</a>
			<div id="prof-btn">копировать [Н|П|З]</div>
			<div id="prof-btn2">копировать STEAM ID</div>
			</div>
			</div>
		<?php endif; ?>
		
		<div class="prof-info">
			<h1 style="display:flex;justify-content:center;">Информация</h1>
			<div class ="text-prof">
				<p>
				Номер: <?php echo $user['number'] ?>
				<br>
				Позывной: <?php echo $user['name'] ?>
				<br>
				Фаза: <?php echo $user['phase']; ?>
				<br>
				<?php
					if ($user['steamid']) {
							echo '<br>';
							echo '<span class="find">Steam:<a href="'.$user['profurl'].'"><img src="img/steam.png" style="height:50px;margin:5px;" />Подключено</a></span>';
						} else {
							echo 'Steam: Не подключен';
							echo '<br>';
						}
						?>
						
					<?php 
						if ($user ['dsid']) {
							echo '<br>';
							echo '<span class="find">Discord:<a href=""><img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</a></span>';
						} else {
							echo '<br>';
							echo 'Discord: Не подключен';
						}
					?>
					<br><br>
				Легион: <?php
					if ($user['legion'] == "501") {
						echo '<span class="leg501">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "212") {
						echo '<span class="leg212">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "41") {
						echo '<span class="leg41">'. $user['legion'] . '</span>'; 
					} else if ($user['legion'] == "Солдат-клон") {
						echo '<span class="legCT">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "Гвардия") {
						echo '<span class="legGVARD">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "ИПК") {
						echo '<span class="legIPK">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "ОДИСБ") {
						echo '<span class="legODISB">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "Медик") {
						echo '<span class="legMED">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "Тренера") {
						echo '<span class="legTREN">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "Без легиона") {
						echo '<span class="N">Без легиона</span>';
					} else if ($user['legion'] == "ЭРК") {
						echo '<span class="legERK">'. $user['legion'] . '</span>';
					} else if ($user['legion'] == "Инструктора"){
						echo '<span class="legTREN">'. $user['legion'] . '</span>';
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
				?>
				<br><br>
				Звание: <?php
				if ($user['bigrang'] =="Рядовой состав" or $user['bigrang'] =="Капральский состав") {
					echo '<span class="R">'. $user['rang'] . '</span>';
				} elseif ($user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Старше-сержантский состав") {
					echo '<span class="S">'. $user['rang'] . '</span>';
				} elseif ($user['bigrang'] == "Мл. офицерский состав") {
					echo '<span class="MO">'. $user['rang'] . '</span>';
				} elseif ($user['bigrang'] == "Офицерский состав") {
					echo '<span class="O">'. $user['rang'] . '</span>';
				} elseif ($user['rang'] == "Советник") {
					echo '<span class="E">'. $user['rang'] . '</span>';
				} else {
					echo '<span class="N">Отсутствует</span>';
				}
			?>
			</div>
		<figure class="highcharts-figure">
				<div id="container"></div>
				<div style="display:flex;justify-content:center;">
					<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна может составлять от 5 до 15 минут</div>
				</figure>
				</div>
		</div>
		<?php elseif ($data['steam'] != NULL) : ?>
			<div class="alert-box">Пользователь не зарегистрирован</div>
			<figure class="highcharts-figure">
				<div id="container"></div>
			</figure>
			<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна может составлять от 5 до 15 минут</div>
		<?php else : ?>
		
		<div class ="alert-box">Пользователь не найден</div>
		
	<?php endif; ?>
	<?php endif; ?>

</div>
<?php 
require __DIR__ . '/footer.php'; 
?>