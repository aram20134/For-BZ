<?php
$title = '[SWRP] Профиль игрока';
$data = $_GET;
require __DIR__ . '/header2.php';
$user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $data['number'], ':ph' => $data['phase']]);

require __DIR__ . '/distab.php';
if ($user['phase'] == 1) {
	$roles = R::findOne('roles', 'discordid = ?', [$user['dsid']]);
} else {
	$roles = R::findOne('roles2', 'discordid = ?', [$user['dsid']]);
}
if ($roles == NULL and $user != NULL) {
	$user->rang = NULL;
	$user->bigrang = NULL;
	$user->legion = NULL;
	R::store($user);
}
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
    		enabled: true,
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
			tickAmount: 6,
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
                valueDecimals: 0,
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
    	chart.setSize($(container).width());
    }
    });
    
</script>
<div class ="content">
	<?php if($data == NULL or $steam == " ็") : ?>
	
	<div class ="alert-box">Страница не найдена</div>
	
	<?php else : ?>
	
		<?php $user = R::findOne('usersbz', 'number = :number AND phase = :phase', [':number' => $data['number'], ':phase' => $data['phase']]); ?>
		<?php if (isset($user)) : ?>
		<?php if($user['legion'] != NULL and $user['rang'] != NULL and $roles != NULL and $user['profurl'] != NULL) : ?>
		<div class="profbz">
		<div class="profbz-content">
			<a target="_blank" href="<?php echo $user['profurl'] ?>"><img style="height:150px;" src="<?php echo $user['avatar']?>"  /></a>
			<?php echo '<div>'  ?>
			<?php echo '<div>'.$user['number']." | ".$user['name'].'</div>' ?>
			<?php echo '<div>'.$user['legion'].'</div>';  ?>
			<?php echo '<div>'.$user['rang'].'</div>';  ?>
			<?php echo '</div>'  ?>
		</div>
			<div class="prof-btns">
			<a target ="_blank" href="<?php echo $user['profurl'] ?>" class="prof-btn">профиль</a>
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
							echo '<span class="find">Steam:<a target="_blank" href="'.$user['profurl'].'"><img src="img/steam.png" style="height:50px;margin:5px;" />Подключено</a></span>';
						} else {
							echo 'Steam: Не подключен';
							echo '<br>';
						}
						?>
						
					<?php 
						if ($user ['dsid']) {
							echo '<br>';
							echo '<span class="find">Discord:<img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</span>';
						} else {
							echo '<br>';
							echo 'Discord: Не подключен';
						}
					?>
					<br><br>
				Легион: <?php $user = R::findOne('usersbz', 'number = :n AND phase = :ph', [':n' => $data['number'], ':ph' => $data['phase']]);
					if (isset($roles['roleslist'])) {
						$roles = $roles['roleslist'];
						// $user['rang'] = NULL;
						$user['bigrang'] = NULL;
						$user['legion'] = NULL;
						R::store($user);
					} else {
						$roles = NULL;
					}
					
					if ($roles != NULL and $user['phase'] == "1") {
						if (strpos($roles, '636268496107470850')) {
						$user->legion = "Тренера";
						$user->bigrang = "Мл. офицерский состав";
						R::store($user);
						echo '<span class="legTREN">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '750697611752898600')) {
						$user->legion = "ОДИСБ";
						$user->bigrang = "Мл. офицерский состав";
						R::store($user);
						echo '<span class="legODISB">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '781576937474621460')) {
						$user->legion = "41";
						R::store($user);
						echo '<span class="leg41">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '63626954529990246')) {
						$user->legion = "212";
						R::store($user);
						echo '<span class="leg212">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636269357831290887')) {
						$user->legion = "501";
						R::store($user);
						echo '<span class="leg501">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '650207151335407656')) {
						$user->legion = "Гвардия";
						R::store($user);
						echo '<span class="legGVARD">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '650207588801183791')) {
						$user->legion = "Медик";
						R::store($user);
						echo '<span class="legMED">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636270262475554899')) {
						$user->legion = "ИПК";
						R::store($user);
						echo '<span class="legIPK">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636270468797562900')) {
						$user->legion = "Солдат-клон";
						R::store($user);
						echo '<span class="legCT">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636271352591941632')) {
						$user->legion = "Без легиона";
						$user->rang = "Кадет";
						R::store($user);
						echo '<span class="N">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '891062472813977600')) {
						$user->legion = "ОДИСБ";
						$user->rang = "Осужденный";
						R::store($user);
						echo '<span class="legODISB">'. $user['legion'] . '</span>';
					// } // убрать ->
					} elseif (strpos($roles, '650206724287889433') or strpos($roles, '636115360910671892')) {
						$user->legion = "Без легиона";
						$user->rang = "Советник";
						R::store($user);
						echo '<span class="N">'. $user['legion'] . '</span>';
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
					
				} else if ($roles != NULL and $user['phase'] == "2") {
						if (strpos($roles, '758369712106373150')) {
							$user->legion = "Солдат-клон";
							echo '<span class="legCT">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530379817695313950')) {
							$user->legion = "ИПК";
							echo '<span class="legIPK">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758374474197237790')) {
							$user->legion = "41";
							echo '<span class="leg41">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530378413257785365')) {
							$user->legion = "212";
							echo '<span class="leg212">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530377477726535695')) {
							$user->legion = "501";
							echo '<span class="leg501">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758371450020560916')) {
							$user->legion = "Гвардия";
							echo '<span class="legGVARD">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758373770704191548')) {
							$user->legion = "Медик";
							echo '<span class="legMED">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758375394667003974')) {
							$user->legion = "Инструкторы";
							$user->bigrang = "Инструкторы";
							echo '<span class="legTREN">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758377044031176756')) {
							$user->legion = "ОДИСБ";
							echo '<span class="legODISB">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '538347524118020096')) { // Осужденный
							$user->legion = "ОДИСБ";
							$user->rang = "Осужденный";
							echo '<span class="legODISB">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758372584474804365')) { // Советник
							$user->legion = "Без легиона";
							$user->rang = "Советник";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '758369039994847312')) { // Кадет
							$user->legion = "Без легиона";
							$user->rang = "Кадет";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '530367354782089226'))  { // Админ
							$user->legion = "Без легиона";
							$user->rang = "Советник";
							echo '<span class="N">'. $user['legion'] . '</span>';
							R::store($user);
						} else if (strpos($roles, '714416434737840148'))  {
							$user->legion = "ЭРК";
							echo '<span class="legERK">'. $user['legion'] . '</span>';
							R::store($user);
						} else {
							echo '<span class="N">Отсутствует</span>';
						}
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
					
				?>
				<br><br>
				Звание: <?php 
				if ($roles != NULL and $user['phase'] == "1") {
					if (strpos($roles, '636274085441044489')) {
					// $user->rang = NULL; // Рядовой состав
					$user->bigrang = "Рядовой состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273807589376012')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273574352650240')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273329434656773')) {
					// $user->rang = NULL; // Офицерский состав	
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '698240245149335583')) {
					$user->rang = "Зам. начальника";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268938631839765')) {
					$user->rang = "Начальник";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268248186224700')) {
					$user->rang = "Командир";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267521997144086')) {
					$user->rang = "Тренер 1-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '941259701700685856')) {
					$user->rang = "Тренер 2-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '941259711364345889')) {
					$user->rang = "Тренер 3-го ранга";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '745142892355649657')) {
					$user->rang = "Главврач";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '745142845672915005')) {
					$user->rang = "Капитан 3-го класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267840537755657')) {
					$user->rang = "Командир первого класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '725828334575026268')) {
					$user->rang = "Капитан 2-го класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267285337604148')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 3-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '725828326253658193')) {
					$user->bigrang = NULL;
					$user->rang = "Капитан 1-го класса";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636266998032105502')) {
					$user->bigrang = NULL;
					$user->rang = "Клон коммандер";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636266583567892485')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 2-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205871552331776')) {
					$user->bigrang = NULL;
					$user->rang = "Адмирал флота";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205254494978048')) {
					$user->bigrang = NULL;
					$user->rang = "Клон маршал";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650205933225639957')) {
					$user->bigrang = NULL;
					$user->rang = "Военврач 1-го ранга";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '650206724287889433')) {
					$user->legion = "Без легиона";
					$user->rang = "Советник";
					echo '<span class="E">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636271352591941632')) {
					$user->legion = "Без легиона";
					$user->rang = "Кадет";
					echo '<span class="N">'. $user['rang'] . '</span>'; 
				}  else {
					if ($user['bigrang'] == "Рядовой состав" and $user['rang'] != NULL) {
						echo '<span class="R">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Сержантский состав" and $user['rang'] != NULL) {
						echo '<span class="S">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Мл. офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="O">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Кадет") {
						echo '<span class="N">'. $user['rang'] . '</span>'; 
					} else if (($user['legion'] == "Без легиона" and $user['rang'] == "Советник") and ($user['number'] == "2563" or $user['number'] == "7266")) {
						echo '<span class="A">'. $user['rang'] . '</span>'; 
					} else if ($user['rang'] == NULL) {
						echo '<span class="N">Отсутствует</span>';
					}
				} 
			 	} else if ($roles != NULL and $user['phase'] == "2") {
					 $c = 1;
					if (strpos($roles, '530382067167657984')) {
					// $user->rang = NULL; // Рядовой состав
					$user->bigrang = "Рядовой состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530388776124547092')) {
					// $user->rang = NULL; // Капральский состав
					$user->bigrang = "Капральский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382020451368962')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382190186463252')) {
					// $user->rang = NULL; // Старше-сержантский состав
					$user->bigrang = "Старше-сержантский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381962511253514')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381907163217926') or strpos($roles, '944640382317240360')) {
					// $user->rang = NULL; // Офицерский состав
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '758375394667003974')) {
					// $user->rang = NULL; // Офицерский состав
					$user->bigrang = "Инструкторы";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="N">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530386071670751242')) {
					$user->rang = "Командир";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530386137370460160')) {
					$user->rang = "Командир первого класса";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530386077769531392')) {
					$user->rang = "Коммандер";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530385530718781450')) {
					$user->rang = "Маршал-коммандер";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530531632172761119')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Адмирал";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = "КМД ИПК";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '538377815062478858')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Военврач 1-го ранга";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = "КМД МЕД";
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '538346330465239050')) {
					if (strpos($roles, '780540907522883594')) {
						$user->rang = "Начальник ОДИСБ";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else {
						$user->bigrang = 'КМД ОДИСБ';
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} if (strpos($roles, '530388056797216790')) { 
					if (strpos($roles, '780540907522883594')) { // Глава подразделения
						$user->rang = "Каминоанский инструктор 1-го ранга";
						$user->bigrang = NULL;
						echo '<span class="K">'. $user['rang'] . '</span>';
					} else { // Другие кмд
						$user->bigrang = 'КМД Инструкторы';
						if ($user['rang'] == NULL) {
							$c = 0;
							echo '<span class="K">Отсутствует</span>';
							// echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						} else {
							echo '<span class="K">'. $user['rang'] . '</span>';
						}
					}
				} else {
					if (($user['bigrang'] == "Рядовой состав" or $user['bigrang'] == "Капральский состав") and $user['rang'] != NULL) {
						echo '<span class="R">'. $user['rang'] . '</span>'; 
					} else if (($user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Старше-сержантский состав") and $user['rang'] != NULL) {
						echo '<span class="S">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Мл. офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Офицерский состав" and $user['rang'] != NULL) {
						echo '<span class="O">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Кадет") {
						echo '<span class="N">'. $user['rang'] . '</span>'; 
					} else if (($user['legion'] == "Без легиона" and $user['rang'] == "Советник") and ($user['number'] == "2563" or $user['number'] == "7266")) {
						echo '<span class="A">'. $user['rang'] . '</span>'; 
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Советник") {
						echo '<span class="E">'. $user['rang'] . '</span>'; 
					} else if ($user['bigrang'] == "Инструкторы" and $user['rang'] != NULL) {
						echo '<span class="MO">'. $user['rang'] . '</span>'; 
					} else if ($user['rang'] == NULL and $c == "1") {
						echo '<span class="N">Отсутствует</span>';
					} 
				}
				} else {
					echo '<span class="R">Отсутствует</span>'; 
				}
				R::store($user);
				?>
				<?php
				if ($user['phase'] == 1) {
					$roles = R::findOne('roles', 'discordid = ?', [$user['dsid']]);
				} else {
					$roles = R::findOne('roles2', 'discordid = ?', [$user['dsid']]);
				}
					if ($user['dsav'] != NULL) {
						showdis($user, $roles, $user['phase'], false);
					}
				?>
				
			<!--Звание: -->
			<?php
			// 	if ($user['bigrang'] =="Рядовой состав" or $user['bigrang'] =="Капральский состав") {
			// 		echo '<span class="R">'. $user['rang'] . '</span>';
			// 	} elseif ($user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Старше-сержантский состав") {
			// 		echo '<span class="S">'. $user['rang'] . '</span>';
			// 	} elseif ($user['bigrang'] == "Мл. офицерский состав") {
			// 		echo '<span class="MO">'. $user['rang'] . '</span>';
			// 	} elseif ($user['bigrang'] == "Офицерский состав") {
			// 		echo '<span class="O">'. $user['rang'] . '</span>';
			// 	} elseif ($user['rang'] == "Советник") {
			// 		echo '<span class="E">'. $user['rang'] . '</span>';
			// 	} else {
			// 		echo '<span class="N">Отсутствует</span>';
			// 	}
			// ?>
			</div>
		<figure class="highcharts-figure">
				<div id="container"></div>
				<div style="display:flex;justify-content:center;">
					<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна составляет менее 5 минут</div>
				</figure>
				</div>
		</div>
		<?php elseif ($data['steam'] != NULL) : ?>
			<div class="alert-box">Пользователь не зарегистрирован</div>
			<figure class="highcharts-figure">
				<div id="container"></div>
			</figure>
			<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна составляет менее 5 минут</div>
		<?php else : ?>
		
		<div class ="alert-box">Пользователь не найден</div>
		
	<?php endif; ?>
	<?php endif; ?>

</div>
<?php 
require __DIR__ . '/footer.php'; 
?>