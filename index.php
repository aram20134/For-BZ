<?php
$title="[SWRP] Главная";
require "db.php";
require __DIR__ . '/header.php';
$bz1 = R::getAssoc('SELECT * FROM bz1');
$bz2 = R::getAssoc('SELECT * FROM bz2');
?>

<?php
// ПЕРВЫЙ СЕРВЕР
$url="http://83.234.136.125:3333/players";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);
// print_r($result);

?>

<?php
// ВТОРОЙ СЕРВЕР
$url2="http://83.234.136.125:3334/players2";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);
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
	$desc = "Контроль территорий";
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
	$desc = "Цитадель";
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

if ($result2['map'] == "rp_corellia_ngg_winter" or $result2['map'] == "rp_corellia_ngg") {
	$map2 = "Corellia";
	$desc2 = "База";
} elseif ($result2['map'] == "ngg_sw_m3") {
	$map2 = "Tatooine";
	$desc2 = "Симуляция сражения";
} elseif ($result2['map'] == "ngg_sw_m12") {
	$map2 = "Takodana";
	$desc2 = "Превосходство";
} elseif ($result2['map'] == "ngg_sw_m6") {
	$map2 = "Geonosis";
	$desc2 = "Контроль территорий";
} elseif ($result2['map'] == "ngg_sw_m10") {
	$map2 = "Korriban";
	$desc2 = "Контроль территорий";
} elseif ($result2['map'] == "ngg_sw_m11") {
	$map2 = "Naboo";
	$desc2 = "Симуляция сражения";
} elseif ($result2['map'] == "ngg_sw_m4") {
	$map2 = "Tatooine";
	$desc2 = "Цитадель";
	$sim2 = "1";
} elseif ($result2['map'] == "ngg_sw_m7") {
	$map2 = "Geonosis";
	$desc2 = "Цитадель";
	$gen2 = "1";
} elseif ($result2['map'] == "ngg_sw_m5") {
	$map2 = "Naboo";
	$desc2 = "Превосходство";
	$nabo2 = "1";
} elseif ($result2['map'] == "ngg_sw_m13") {
	$map2 = "Mygeeto";
	$desc2 = "Контроль территорий";
} else {
	$map2 = "Corellia";
	$desc2 = "База";
}
?>
<script src="jquery-3.6.0.min.js"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<!-- <script>
		function show () {
			$.ajax ({
				url: 'https://swrpngg.space/api/getplayers',
				method: 'get',
				dataType: 'json',
				cache: false,
				success: function(data) {
					document.getElementById('onl').innerHTML = data['raw']['numplayers'] + "/128";
				}
			});
		}
		function show2 () {
			$.ajax ({
				url: 'https://swrpngg.space/api/getplayers2',
				method: 'get',
				dataType: 'json',
				cache: false,
				success: function(data) {
					document.getElementById('onl2').innerHTML = data['raw']['numplayers'] + "/128";
				}
			});
		}
                		$(document).ready(function() {
							show();
							setInterval('show()', 10000);
						});
                		$(document).ready(function() {
							show2();
							setInterval('show2()', 10000);
						});
</script> -->
<!--SCRYPT-->
    <script>
    var map =  '<?php echo $map ?>';
    var map2 = '<?php echo $map2 ?>';
    
    var sim1 = '<?php echo $sim1 ?>';
    var sim2 = '<?php echo $sim2 ?>';
    
    var gen1 = '<?php echo $gen1 ?>';
    var gen2 = '<?php echo $gen2 ?>';
    
    var nabo1 = '<?php echo $nabo1 ?>';
    var nabo2 = '<?php echo $nabo2 ?>';
    $(document).ready(function(){$(".first").hover(function(){$(this).hasClass("active-server")||$(this).toggleClass("box-online-hover")});$(".second").hover(function(){$(this).hasClass("active-server")||$(this).toggleClass("box-online-hover")});"Anaxes"==map?$(".first").toggleClass("map-anaxes"):"Tatooine"==map&&"1"==sim1?$(".first").toggleClass("map-tatooine_sim"):"Geonosis"==map&&"1"==gen1?$(".first").toggleClass("map-geonosis2"):"Naboo"==map&&"1"==nabo1?$(".first").toggleClass("map-naboo2"):"Korriban"==
map?$(".first").toggleClass("map-korriban"):"Geonosis"==map?$(".first").toggleClass("map-geonosis"):"Tatooine"==map?$(".first").toggleClass("map-tatooine"):"Takodana"==map?$(".first").toggleClass("map-takodana"):"Naboo"==map?$(".first").toggleClass("map-naboo"):"Mygeeto"==map&&$(".first").toggleClass("map-naboo");"Corellia"==map2?$(".second").toggleClass("map-corellia"):"Tatooine"==map2&&"1"==sim2?$(".second").toggleClass("map-tatooine_sim"):"Geonosis"==map2&&"1"==gen2?$(".second").toggleClass("map-geonosis2"):
"Naboo"==map2&&"1"==nabo1?$(".second").toggleClass("map-naboo2"):"Korriban"==map2?$(".second").toggleClass("map-korriban"):"Naboo"==map2?$(".second").toggleClass("map-naboo"):"Tatooine"==map2?$(".second").toggleClass("map-tatooine"):"Takodana"==map2?$(".second").toggleClass("map-takodana"):"Geonosis"==map2?$(".second").toggleClass("map-geonosis"):"Mygeeto"==map2&&$(".second").toggleClass("map-mygeeto")});
    </script>
<script>    
$(document).ready(function(){
    var online = [
        <?php 
            foreach ($bz1 as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['pick'].'],';
                }
            }  
        ?>
    ];

    var online2 = [
        <?php 
            foreach ($bz2 as $key => $value) {
                if (!(date("d").date("m").date("Y") == $value['d'].$value['m'].$value['y'])) {
                    $value['m']--;
                    echo '[Date.UTC('.$value['y'].','.$value['m'].','.$value['d'].'),'.$value['pick'].'],';
                }
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
            rangeSelectorZoom: "[Период]",
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
        legend: {
            enabled: true,
            backgroundColor: '#FCFFC5',
            borderColor: 'black',
            borderWidth: 2,
            shadow: true,
        },
    	navigator: {
    		enabled: true,
            series: [{
                data: online,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }, {
                data: online2,
                opacity: 0.5,
                fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
            }],
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
            enabled: true, // false by default
            allButtonsEnabled: true,
            selected: '0',
            buttons: [{
                type: 'week',
                count: 1,
                text: 'Неделя',
            }, {
                type: 'all',
                text: 'Всё',
            }],
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
            text: 'Пиковый онлайн Phase 1 и Phase 2',
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
            tickAmount: 8,
            min: 0,
            max: 120,
            lineWidth: 2,
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
            area: {
                opacity: 0.7,
            },
        	series: {
            	borderWidth: 1,
            	// color: 'green',
            	lineWidth: 4,
            	dataLabels: {
                	enabled: true,
                	format: '{y}'
            	}
        	}
    	},
        series: [{
            name: 'Пиковый онлайн Phase 1',
            type: 'area',
            data: online,
            // opacity: 0.5,
            color: 'red',
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'red',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[5]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
            },
        }, {
            name: 'Пиковый онлайн Phase 2',
            type: 'area',
            // opacity: 0.5,
            color: 'blue',
            data: online2,
            tooltip: {
                valueDecimals: 0,
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 4,
                fillColor: 'blue',
            },
            fillColor: {
                linearGradient: {
                    x1: 0,
                    y1: 0,
                    x2: 0,
                    y2: 2
                },
                stops: [
                    [0, Highcharts.getOptions().colors[4]],
                    [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                ]
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
<!--SCRYPT-->
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
    <div class="content">

        <div class="menu-content">
            <h3>Добро пожаловать!</h3>
            <p>Это экспериментальная версия сайта, неофициально связанная с проектами SWRP NGG. Главной его функцией является отображение статуса серверов, игроков на сервере и их онлайн. Регистрация позволит выводить ваше НПЗ вместо ника в стиме. Все данные обновляются в реальном времени.
                
            </p>
        </div>
        <h1 class="online-head">СТАТУС СЕРВЕРОВ</h1>
        <div class="online-log">
        	<p class="name-server">
                Русский StarWars Phase 1 | Быстрая загрузка
            </p>
            <a href="swrp1" style="display:inherit;width:100%;justify-content:center;">
            <div class="box-online first">
            	<div class="description">ПОДРОБНЕЕ</div>
                <div class="text-online1">
                	<img src="img/planet5.png" class="ico">
                	<div class = "maps">
                		<div class = "m"><?php echo $map; ?></div>
                		<div><?php echo $desc; ?></div>
                	</div>
                </div>
                <div class="text-online1">
                	<img src="img/phase1/clone1.png" class="ico2">
                	<div id="onl"></div>
                	<?php 
                	if ($result['raw']['numplayers'] != NULL) {
                		echo $result['raw']['numplayers']."/128"; 
                	} else {
                		echo 'Offline';
                	}
                	?>
                </div>
				<?php 
					if ($result['raw']['numplayers'] != NULL) {
						echo '<div id="difftime"></div>';
					} else {
						echo '<div id="difftime" style="background-color:red;"></div>';
					}
				?>
            </div>
            </a>
            <p class="name-server">
                Русский StarWars Phase 2 | Быстрая загрузка
            </p>
            <a href="swrp2" style="display:inherit;width:100%;justify-content:center;">
            <div class="box-online second">
                <div class="description">ПОДРОБНЕЕ</div>
                <div class="text-online2">
                	<img src="img/planet3.png" class="ico">
                	<div class = "maps">
                		<div class = "m"><?php echo $map2; ?></div>
                		<div><?php echo $desc2; ?></div>
                	</div>
                </div>
            	<div class="text-online2">
                	<img src="img/phase2/clone2.png" class="ico2">
                	<div id="onl2"></div>
                	<?php 
                	if ($result2['raw']['numplayers'] != NULL) {
                		echo $result2['raw']['numplayers']."/128"; 
                	} else {
                		echo 'offline';
                	}
                	?>
                </div>
                <?php 
					if ($result2['raw']['numplayers'] != NULL) {
						echo '<div id="difftime"></div>';
					} else {
						echo '<div id="difftime" style="background-color:red;"></div>';
					}
				?>
            </div>
            </a>
        </div>
		<div style="margin:20px;" id ="container"></div>
    </div>
<!--STOP HERE--> <!--STOP HERE--> <!--STOP HERE-->
<?php 
require __DIR__ . '/footer.php'; 
?>