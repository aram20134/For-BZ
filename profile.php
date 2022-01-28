<?php
$title="[SWRP] Профиль";
require "db.php";
require __DIR__ . '/header.php';
require "steamauth/steamauth.php";
$legion = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Тренера", "Гвардия"];
$rang = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Клон коммандер", "Клон маршал"];
$med = ["Интерн", "Практикант", "Ординатор", "Старший ординатор", "Военфельдшер", "Старший военфельдшер", "Врач", "Полевой врач", "Хирург", "Главный хирург", "Главврач", "Военврач 3-го ранга", "Военврач 2-го ранга", "Военврач 1-го ранга"];
$pil = ["Пилот-рекрут", "Пилот", "Старшина", "Сержант", "Первый сержант", "Сержант-майор воздушных войск", "Прапорщик", "Лейтенант флота", "Лейтенант-коммандер", "Коммандер", "Капитан 3 класса", "Капитан 2 класса", "Капитан 1 класса", "Адмирал флота"];
$ODISB = ["Осужденный", "Стажер", "Смотритель", "Оперативник", "Старший оперативник", "Дознаватель", "Руководитель", "Заместитель начальника", "Начальник"];
$tren = ["Контрактный тренер", "Тренер-практикант", "Тренер", "	Старший тренер", "Тренер спец. назнния", "Мандалорский тренер"];

$legion2 = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Инструктора", "Гвардия", "ЭРК"];
$rang2 = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Коммандер", "Маршал-коммандер"];
$med2 = ["Ассистент", "Интерн", "Ординатор", "Младший военфельдшер", "Военфельдшер", "Старший военфельдшер", "Полевой врач", "Врач", "Хирург", "Военный хирург", "Главврач", "Военврач 3-го ранга", "Военврач 2-го ранга", "Военврач 1-го ранга"];
$pil2 = ["Пилот-рекрут", "Пилот", "Пилот первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор воздушных войск", "Прапорщик", "Младший лейтенант", "Лейтенант", "Лейтенант-командир", "Командир", "Капитан", "Младший контр-адмирал", "Контр-адмирал", "Вице Адмирал", "Адмирал", "Адмирал флота"];
$ODISB2 = ["Осужденный", "Стажер", "Младший смотритель", "Смотритель", "Старший смотритель", "Смотритель первого класса", "Оперативник", "Бригадир", "Надзиратель", "Второй заместитель начальника", "Первый заместитель начальника", "Начальник"];
$tren2 = ["Младший инструктор", "Инструктор", "Старший инструктор", "Оперативный инструктор", "Каминоанский инструктор 3-го ранга", "Каминоанский инструктор 2-го ранга", "Каминоанский инструктор 1-го ранга"];
$erk2 = ["Лейтенант", "Капитан", "Коммандер"];
?>
<?php $user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]); ?>
<?php $roles = R::findOne('site', 'discordid = ?', [$user['dsid']]); ?>

<script src="jquery-3.6.0.min.js"></script>
<!--GRAPHICS-->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>



<?php if ($user['steamname'] != NULL) : ?>

<script type="text/javascript">
<?php 
	$online = R::findAll('online', 'steamname = ?', [$user['steamname']]);
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
    		backgroundColor: 'transparent',
    	},
    	navigator: {
    		enabled: false,
    	},
    	scrollbar: {
    		enabled: false,
    	},
        rangeSelector: {
        	enabled: false,
            selected: 1,
            buttonTheme: {
            	fill: 'none',
            	r: 8,
            	style: {
            		color: '#039',
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
        		color: 'white'
        		}
			},
    	},
        title: {
            text: 'Онлайн <?php echo "[".$user['number']." | ".$user['name']."]" ?>',
            style: {
            	color: 'white',
            	fontWeight: 'bold'
            },
        },
        plotOptions: {
        	series: {
            	borderWidth: 1,
            	color: 'darkred',
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
                valueDecimals: 2
            },
            marker: {
                enabled: true,
                lineWidth: 2,
                radius: 5,
                fillColor: 'red',
            },
        }]
    });
    if (window.matchMedia("(min-width: 1024px)").matches) {
    	
	} else {
		chart.setSize(600);
	}
    if (window.matchMedia("(min-width: 600px)").matches) {
    	
    } else {
    	chart.setSize(300);
    }
    });
</script>

<?php else : ?>
<div style="display:flex;justify-content:center;">
<div class="alert-box">Для просмотра своего онлайна привяжите свой Steam</div>
<?php $onl = true; ?>
</div>
<?php endif ?>
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
		var phase = "<?php echo $_SESSION['logged_user']->phase ?>";
		
		// if (phase == "1") {
		// 	$('#phase2').addClass('not-active')
		// 	$('.choice1').click(function(){
		// 	$('.ch-leg').toggleClass('active-l');
		// 	console.log("Phase 1");
		// });
		// $('.ch-leg li').click(function (){
		// 	$('input[name=legion]').val(this.value);
		// 	var leg = $('input[name=legion]').val();
			
		// 	let legion = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Тренера", "Гвардия"];
		// 	let rang = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Клон коммандер", "Клон маршал"];
		// 	let pil = ["Пилот-рекрут", "Пилот", "Старшина", "Сержант", "Первый сержант", "Сержант-майор воздушных войск", "Прапорщик", "Лейтенант флота", "Лейтенант-коммандер", "Коммандер", "Капитан 3 класса", "Капитан 2 класса", "Капитан 1 класса", "Адмирал флота"];
		// 	let odisb = ["Осужденный", "Стажер", "Смотритель", "Оперативник", "Старший оперативник", "Дознаватель", "Руководитель", "Заместитель начальника", "Начальник"];
		// 	let med = ["Интерн", "Практикант", "Ординатор", "Старший ординатор", "Военфельдшер", "Старший военфельдшер", "Врач", "Полевой врач", "Хирург", "Главный хирург", "Главврач", "Военврач 3-го ранга", "Военврач 2-го ранга", "Военврач 1-го ранга"];
		// 	let tren = ["Контрактный тренер", "Тренер-практикант", "Тренер", "Старший тренер", "Тренер спец. назнния", "Мандалорский тренер"];
		// 	$('.choice1').text(legion[leg]);
			
		// 	if(leg == "0" || leg == "1" || leg == "2" || leg == "3" || leg == "8") {
		// 		$('.choice2').addClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice2').click(function(){
		// 			$('.ch-rang').toggleClass('active-ul');
		// 		});
		// 		$('.ch-rang li').click(function () {
		// 			$('input[name=rang]').val(this.value);
		// 			var rng = $('input[name=rang]').val();
		// 			console.log(rng);
		// 			$('.choice2').text(rang[rng]);
		// 		});
		// 	} else if (leg == "6") {
		// 			$('.ch-pil li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice3').text(pil[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').addClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice3').click(function() {
		// 			$('.ch-pil').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "5") {
		// 			$('.ch-odisb li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice4').text(odisb[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice4').addClass('active-ul');
		// 		$('.choice4').click(function() {
		// 			$('.ch-odisb').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "4") {
		// 			$('.ch-med li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice5').text(med[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice5').addClass('active-ul');
		// 		$('.choice5').click(function() {
		// 			$('.ch-med').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "7") {
		// 			$('.ch-tren li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice6').text(tren[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').addClass('active-ul');
		// 		$('.choice6').click(function() {
		// 			$('.ch-tren').toggleClass('active-ul');
		// 		});
		// 	} else {
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 	}
		// });
		// // СДЕЛАТЬ ВЫБОР ЗВАНИЯ И ЛЕГИОНА 2 ФАЗЫ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		// } else {
		// 	$('#phase1').addClass('not-active')
		// 	$('.choice1').click(function(){
		// 	$('.ch-leg')~.toggleClass('active-l');
		// 	console.log("Phase 2");
		// });
		// $('.ch-leg li').click(function (){
		// 	$('input[name=legion]').val(this.value);
		// 	var leg = $('input[name=legion]').val();
			
		// 	let legion2 = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Инструктора", "Гвардия", "ЭРК"];
		// 	let rang2 = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Коммандер", "Маршал-коммандер"];
		// 	let pil2 = ["Пилот-рекрут", "Пилот", "Пилот первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор воздушных войск", "Прапорщик", "Младший лейтенант", "Лейтенант", "Лейтенант-командир", "Командир", "Капитан", "Младший контр-адмирал", "Контр-адмирал", "Вице Адмирал", "Адмирал", "Адмирал флота"];
		// 	let odisb2 = ["Осужденный", "Стажер", "Младший смотритель", "Смотритель", "Старший смотритель", "Смотритель первого класса", "Оперативник", "Бригадир", "Надзиратель", "Второй заместитель начальника", "Первый заместитель начальника", "Начальник"];
		// 	let med2 = ["Ассистент", "Интерн", "Ординатор", "Младший военфельдшер", "Военфельдшер", "Старший военфельдшер", "Полевой врач", "Врач", "Хирург", "Военный хирург", "Главврач", "Военврач 3-го ранга", "Военврач 2-го ранга", "Военврач 1-го ранга"];
		// 	let tren2 = ["Младший инструктор", "Инструктор", "Старший инструктор", "Оперативный инструктор", "Каминоанский инструктор 3-го ранга", "Каминоанский инструктор 2-го ранга", "Каминоанский инструктор 1-го ранга"];
		// 	let erk2 = ["Лейтенант", "Капитан", "Коммандер"];
		// 	$('.choice1').text(legion2[leg]);
			
		// 	if(leg == "0" || leg == "1" || leg == "2" || leg == "3" || leg == "8") {
		// 		$('.choice2').addClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 		$('.choice2').click(function(){
		// 			$('.ch-rang').toggleClass('active-ul');
		// 		});
		// 		$('.ch-rang li').click(function () {
		// 			$('input[name=rang]').val(this.value);
		// 			var rng = $('input[name=rang]').val();
		// 			console.log(rng);
		// 			$('.choice2').text(rang2[rng]);
		// 		});
		// 	} else if (leg == "6") {
		// 			$('.ch-pil li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice3').text(pil2[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').addClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 		$('.choice3').click(function() {
		// 			$('.ch-pil').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "5") {
		// 			$('.ch-odisb li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice4').text(odisb2[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 		$('.choice4').addClass('active-ul');
		// 		$('.choice4').click(function() {
		// 			$('.ch-odisb').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "4") {
		// 			$('.ch-med li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice5').text(med2[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 		$('.choice5').addClass('active-ul');
		// 		$('.choice5').click(function() {
		// 			$('.ch-med').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "7") {
		// 			$('.ch-tren li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice6').text(tren2[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 		$('.choice6').addClass('active-ul');
		// 		$('.choice6').click(function() {
		// 			$('.ch-tren').toggleClass('active-ul');
		// 		});
		// 	} else if (leg == "9") {
		// 		console.log("9");
		// 		$('.ch-erk li').click(function () {
		// 				$('input[name=rang]').val(this.value);
		// 				var rng = $('input[name=rang]').val();
		// 				console.log(rng);
		// 			$('.choice7').text(erk2[rng]);
		// 		});
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').addClass('active-ul');
		// 		$('.choice7').click(function() {
		// 			$('.ch-erk').toggleClass('active-ul');
		// 		});
		// 	} else {
		// 		$('.choice3').removeClass('active-ul');
		// 		$('.choice2').removeClass('active-ul');
		// 		$('.choice4').removeClass('active-ul');
		// 		$('.choice5').removeClass('active-ul');
		// 		$('.choice6').removeClass('active-ul');
		// 		$('.choice7').removeClass('active-ul');
		// 	}
		// });
			
		// }
		
		if (phase == "1") {
			$('#check-rang1').click(function() {
				$('#check-rang2').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang6').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang2').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang6').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang3').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang2').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang6').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang4').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang2').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang6').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang5').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang2').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang6').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang6').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang2').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang7').prop("checked", false);
			});
			$('#check-rang7').click(function() {
				$('#check-rang1').prop("checked", false);
				$('#check-rang2').prop("checked", false);
				$('#check-rang3').prop("checked", false);
				$('#check-rang4').prop("checked", false);
				$('#check-rang5').prop("checked", false);
				$('#check-rang6').prop("checked", false);
			});
		}
	});
</script>
<?php if(isset($_SESSION['logged_user'])) : ?>
	<div class ="content">
		<?php if($user['legion'] != NULL and $user['rang'] != NULL and $user['steamid'] != NULL) : ?>
		<div class="profbz">
		<div class="profbz-content">
			<a href="<?php echo $user['profurl'] ?>"><img style="height:150px;" src="<?php echo $user['avatar']?>"  /></a>
			<?php echo '<div>'  ?>
			<?php echo '<div>'.$_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name.'</div>' ?>
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
				<?php 
				if ($user['steamid'] == NULL or $user['dsid'] == NULL) {
					echo '<span class ="alert-box">Для полноценной работы функционала сайта подключите Steam и Discord</span>';
				}
				?>
				Ваш номер: <?php echo $_SESSION['logged_user']->number ?>
				<br>
				Ваш позывной: <?php echo $user['name'] ?> <span><a href="change-name" style="text-decoration:underline;">Сменить</a></span>
				<br>
				Фаза: <?php echo $_SESSION['logged_user']->phase; ?>
				<br>
				 <?php
					$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
					
					require 'steamauth/userInfo.php';
					
					if ($user['steamid']) {
							if(isset($_SESSION['steamid'])) {
								$user->steamid =  $_SESSION['steam_steamid'];
								$user->avatar = $_SESSION['steam_avatarfull'];
								$user->profurl = $_SESSION['steam_profileurl'];
								$user->steamname = $_SESSION['steam_personaname'];
							}
							echo '<br>';
							echo '<span class="find">Steam:<a href="'.$user['profurl'].'"><img src="img/steam.png" style="height:50px;margin:5px;" />Подключено</a></span>';
							echo '<a href="steamauth/logout.php" style="text-decoration:underline;">(Выйти)</a>';
							
						} else if (isset($_SESSION['steamid'])) {
							$user->steamid = $_SESSION['steam_personaname'];
							$user->avatar = $_SESSION['steam_avatarfull'];
							$user->profurl = $_SESSION['steam_profileurl'];
						} else {
							echo 'Steam: ';loginButton(); echo '<span data="Подключите Steam аккаунт, чтобы вы и другие пользователи могли видеть ваш номер и позывной в списке игроков вашей фазы."><img src="img/info.png" class="ico-info"/></span>';
						}
						
						R::store($user);
						
						?>
				<br>
<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)
error_reporting(E_ALL);
define('OAUTH2_CLIENT_ID', '929337070084825168');
define('OAUTH2_CLIENT_SECRET', 'L16oTijCr23v647O3R21iEesZcWuWcHI');
$authorizeURL = 'https://discord.com/api/oauth2/authorize?client_id=929337070084825168&redirect_uri=https%3A%2F%2Fswrpngg.space%2Fprofile&response_type=code&scope=identify%20connections';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discord.com/api/users/@me';
$revokeURL = 'https://discord.com/api/oauth2/token/revoke';

$dis = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);




function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    $headers[] = 'Accept: application/json';
    if(session('access_token'))
      $headers[] = 'Authorization: Bearer ' . session('access_token');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    return json_decode($response);
  }
  function get($key, $default=NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
  }
  function session($key, $default=NULL) {
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
  }

if(get('action') == 'login') {
  $params = array(
    'client_id' => OAUTH2_CLIENT_ID,
    'redirect_uri' => 'https://swrpngg.space/profile',
    'response_type' => 'code',
    'scope' => 'identify connections email'
  );
  // Redirect the user to Discord's authorization page
  header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
  die();
}
if(get('code')) {
    // Exchange the auth code for a token
    $token = apiRequest($tokenURL, array(
      "grant_type" => "authorization_code",
      'client_id' => OAUTH2_CLIENT_ID,
      'client_secret' => OAUTH2_CLIENT_SECRET,
      'redirect_uri' => 'https://swrpngg.space/profile',
      'code' => get('code')
    ));
    $logout_token = $token->access_token;
    $_SESSION['access_token'] = $token->access_token;
    header('Location: https://swrpngg.space/profile');
  }
if(session('access_token')) {
		$user = apiRequest($apiURLBase);
		echo '<span class="find">Discord:<a href=""><img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</a></span>';
		echo '<a href="?action=logout" style="text-decoration:underline;">(Выйти)</a>';
		$dis->dsid = $user->id;
		R::store($dis);
} else if ($dis['dsid'] != NULL) {
		$user = apiRequest($apiURLBase);
		echo '<span class="find">Discord:<a href=""><img src="img/discord.png" style="height:50px;margin:5px;" />Подключено</a></span>';
		echo '<a href="?action=logout" style="text-decoration:underline;">(Выйти)</a>';
	
} else {
	echo 'Discord: <a href="?action=login" style="text-decoration:underline;">Подключить</a>'; echo '<span data="Подключите Discord аккаунт, чтобы вы и другие пользователи могли видеть в списке игроков вашей фазы ваш легион и звание."><img src="img/info.png" class="ico-info"/></span>';
}
if(get('action') == 'logout') {
    apiRequest($revokeURL, array(
        'token' => session('access_token'),
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
      ));
    unset($_SESSION['access_token']);
    $dis['dsid'] = NULL;
    $dis['legion'] = NULL;
    $dis['rang'] = NULL;
    $dis['bigrang'] = NULL;
    $roles['discordid'] = NULL;
    $roles['roleslist'] = NULL;
    header('Location: https://swrpngg.space/profile');
    R::store($dis);
    R::store($roles);
    exit();
  }

?>
				<br><br>
				Легион: <?php $user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
					if (isset($roles['roleslist'])) {
						$roles = $roles['roleslist'];
						$user['rang'] = NULL;
						$user['bigrang'] = NULL;
						R::store($user);
					} else {
						$roles = NULL;
					}
					
				if ($roles != NULL and $user['phase'] == "1") {
						if (strpos($roles, '636270468797562900')) {
						$user->legion = "Солдат-клон";
						R::store($user);
						echo '<span class="legCT">'. $user['legion'] . '</span>';
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
					} elseif (strpos($roles, '636270262475554899')) {
						$user->legion = "ИПК";
						R::store($user);
						echo '<span class="legIPK">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '650207588801183791')) {
						$user->legion = "Медик";
						R::store($user);
						echo '<span class="legMED">'. $user['legion'] . '</span>';
					} elseif (strpos($roles, '636268496107470850')) {
						$user->legion = "Тренера";
						$user->bigrang = "Мл. офицерский состав";
						R::store($user);
						echo '<span class="legTREN">'. $user['legion'] . '</span>';
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
					} elseif (strpos($roles, '636115360910671892')) {
						$user->legion = "Без легиона";
						$user->rang = "Советник";
						R::store($user);
						echo '<span class="N">'. $user['legion'] . '</span>';
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
							$user->legion = "Инструктора";
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
						} else if (strpos($roles, '758369670851067966')) { // Кадет
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
						if ($user['rang'] == "Рядовой состав") {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273807589376012')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273574352650240')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '636273329434656773')) {
					// $user->rang = NULL; // Офицерский состав	
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '698240245149335583')) {
					$user->rang = "Зам. начальнка";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268938631839765')) {
					$user->rang = "Начальнк";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636268248186224700')) {
					$user->rang = "Командир";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '636267521997144086')) {
					$user->rang = "Мандалорский тренер";
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
					} else if ($user['legion'] == "Без легиона" and $user['rang'] == "Советник") {
						echo '<span class="E">'. $user['rang'] . '</span>'; 
					}
				}
				} else if ($roles != NULL and $user['phase'] == "2") {
					if (strpos($roles, '530382067167657984')) {
					// $user->rang = NULL; // Рядовой состав
					$user->bigrang = "Рядовой состав";
						if ($user['rang'] == "Рядовой состав") {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid green;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530388776124547092')) {
					// $user->rang = NULL; // Капральский состав
					$user->bigrang = "Капральский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382020451368962')) {
					// $user->rang = NULL; // Сержантский состав
					$user->bigrang = "Сержантский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530382190186463252')) {
					// $user->rang = NULL; // Старше-сержантский состав
					$user->bigrang = "Старше-сержантский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381962511253514')) {
					// $user->rang = NULL; // Мл. офицерский состав
					$user->bigrang = "Мл. офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
						}
				} if (strpos($roles, '530381907163217926')) {
					// $user->rang = NULL; // Офицерский состав
					$user->bigrang = "Офицерский состав";
						if ($user['rang'] == NULL) {
							echo '<span class="N">Отсутствует</span>';
							echo '<br><br><span style="border:2px solid red;margin:5px;padding:5px;border-radius:10px;display:inline-flex;">Для отображения в списке игроков, уточните ваше звание ниже</span>';
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
					$user->rang = "Младший контр-адмирал";
					$user->bigrang = "Адмиральский состав";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '538377815062478858')) {
					$user->rang = "Главврач";
					$user->bigrang = "Военврачебный состав";
					echo '<span class="K">'. $user['rang'] . '</span>';
				} if (strpos($roles, '530531787974246428')) {
					$user->rang = "Адмирал флота";
					$user->bigrang = NULL;
					echo '<span class="K">'. $user['rang'] . '</span>';
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
					}
				}
				} else {
					echo '<span class="N">Отсутствует</span>';
				}
				R::store($user);
				
			?>
				</p>
			
			</div>
			<figure class="highcharts-figure">
				<div id="container"></div>
				<div style="display:flex;justify-content:center;">
					<?php if ($onl != true) {
						echo '<div class ="alert-box" style="background:rgb(157, 192, 0, 0.5);border:2px solid green;">Погрешность счёта онлайна может составлять от 5 до 15 минут</div>';
					}
					?>
					
				</div>
			</figure>
			
			
			<?php if($user['bigrang'] == "Рядовой состав" or $user['bigrang'] == "Сержантский состав" or $user['bigrang'] == "Мл. офицерский состав" or $user['bigrang'] == "Офицерский состав") : ?>
			<h1 style="display:flex;justify-content:center;text-align:center;">Укажите свои данные на SWRP Phase <?php echo $_SESSION['logged_user']->phase ?></h1>
			<div class ="alert-box" style="max-width:100%;">
				
				<p>
					Указывайте свои настоящие данные! Иначе ваш аккаунт может быть удалён!
				</p>
			</div>
				<div class="text-prof">
				
			<?php 
				function saverang() {
				$data = $_POST;
				$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
					if(isset($data['save'])) {
						$errors = array();
					
						if(trim($data['rang']) == "") {
							$errors[] = 'Выберите звание!';
						}
						if(!empty($errors)) {
						echo '<div class="alert-box"><p>'. array_shift($errors) . '</p></div>';
						} else {
							$user->rang = $data['rang'];
							R::store($user);
							header('Location: https://swrpngg.space/profile');
							exit;
						}
					}
				}
			?>
			<?php
				if ($user['phase'] == "1") {
					if ($user['bigrang'] == "Рядовой состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Рядовой-рекрут">';
							echo '<label for="check-rang1">Рядовой-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Рядовой">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Рядовой первого класса">';
							echo '<label for="check-rang3">Рядовой первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Специалист">';
							echo '<label for="check-rang4">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Капрал">';
							echo '<label for="check-rang5">Капрал</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Интерн">';
							echo '<label for="check-rang1">Интерн</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Практикант">';
							echo '<label for="check-rang2">Практикант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
								
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Пилот-рекрут">';
							echo '<label for="check-rang1">Пилот-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Пилот">';
							echo '<label for="check-rang2">Пилот</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Старшина">';
							echo '<label for="check-rang3">Старшина</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Сержантский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Штаб-сержант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Сержант первого класса">';
							echo '<label for="check-rang3">Сержант первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang4">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Первый сержант">';
							echo '<label for="check-rang5">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang6" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang6">Сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang7" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang7">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang8" name="rang" value="Сержант-майор сухопутных войск">';
							echo '<label for="check-rang8">Сержант-майор сухопутных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Ординатор">';
							echo '<label for="check-rang1">Ординатор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший ординатор">';
							echo '<label for="check-rang2">Старший ординатор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Первый сержант">';
							echo '<label for="check-rang2">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Сержант-майор воздушных войск">';
							echo '<label for="check-rang3">Сержант-майор воздушных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Мл. офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Мл. лейтенант">';
							echo '<label for="check-rang1">Мл. лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант">';
							echo '<label for="check-rang2">Лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Военфельдшер">';
							echo '<label for="check-rang1">Военфельдшер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший военфельдшер">';
							echo '<label for="check-rang2">Старший военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант флота">';
							echo '<label for="check-rang1">Лейтенант флота</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Прапорщик">';
							echo '<label for="check-rang2">Прапорщик</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Тренера") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Контрактный тренер">';
							echo '<label for="check-rang1">Контрактный тренер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Тренер-практикант">';
							echo '<label for="check-rang2">Тренер-практикант</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Тренер">';
							echo '<label for="check-rang3">Тренер</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Старший тренер">';
							echo '<label for="check-rang4">Старший тренер</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Тренер спец. назначения">';
							echo '<label for="check-rang5">Тренер спец. назначения</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Стажёр">';
							echo '<label for="check-rang1">Стажёр</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Смотритель">';
							echo '<label for="check-rang2">Смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Оперативник">';
							echo '<label for="check-rang3">Оперативник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Старший оперативник">';
							echo '<label for="check-rang4">Старший оперативник</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Дознаватель">';
							echo '<label for="check-rang5">Дознаватель</label>';
							
							echo '<input type="checkbox" id="check-rang6" name="rang" value="Руководитель">';
							echo '<label for="check-rang6">Руководитель</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Капитан">';
							echo '<label for="check-rang1">Капитан</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Майор">';
							echo '<label for="check-rang2">Майор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Подполковник">';
							echo '<label for="check-rang3">Подполковник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Полковник">';
							echo '<label for="check-rang4">Полковник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Врач">';
							echo '<label for="check-rang1">Врач</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Полевой врач">';
							echo '<label for="check-rang2">Полевой врач</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Хирург">';
							echo '<label for="check-rang3">Хирург</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Военный хирург">';
							echo '<label for="check-rang4">Военный хирург</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант-коммандер">';
							echo '<label for="check-rang1">Лейтенант-коммандер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Коммандер">';
							echo '<label for="check-rang2">Коммандер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					}
				} else if ($user['phase'] == "2") {
					if ($user['bigrang'] == "Рядовой состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Рядовой-рекрут">';
							echo '<label for="check-rang1">Рядовой-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Рядовой">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Рядовой первого класса">';
							echo '<label for="check-rang3">Рядовой первого класса</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Ассистент">';
							echo '<label for="check-rang1">Ассистент</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Пилот-рекрут">';
							echo '<label for="check-rang1">Пилот-рекрут</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Пилот">';
							echo '<label for="check-rang2">Пилот</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Пилот первого класса">';
							echo '<label for="check-rang3">Пилот первого класса</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legeion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Стажер">';
							echo '<label for="check-rang1">Стажер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Капральский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Специалист">';
							echo '<label for="check-rang1">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Капрал">';
							echo '<label for="check-rang2">Капрал</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Специалист">';
							echo '<label for="check-rang1">Специалист</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Капрал">';
							echo '<label for="check-rang2">Капрал</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший смотретритель">';
							echo '<label for="check-rang1">Младший смотретритель</label>';

							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						}
					} else if ($user['bigrang'] == "Сержантский состав") {
						if($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang3">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Первый сержант">';
							echo '<label for="check-rang4">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang5">Сержант-майор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Интерн">';
							echo '<label for="check-rang1">Интерн</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Ординатор">';
							echo '<label for="check-rang2">Ординатор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Сержант">';
							echo '<label for="check-rang1">Сержант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Штаб-сержант">';
							echo '<label for="check-rang2">Рядовой</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Мастер сержант">';
							echo '<label for="check-rang3">Мастер сержант</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Первый сержант">';
							echo '<label for="check-rang4">Первый сержант</label>';
							
							echo '<input type="checkbox" id="check-rang5" name="rang" value="Сержант-майор">';
							echo '<label for="check-rang5">Сержант-майор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Смотритель">';
							echo '<label for="check-rang1">Смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший смотритель">';
							echo '<label for="check-rang2">Старший смотритель</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Смотритель первого класса">';
							echo '<label for="check-rang3">Смотритель первого класса</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Оперативник">';
							echo '<label for="check-rang4">Оперативник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Старше-сержантский состав") {
						if($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang1">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Сержант-майор сухопутных войск">';
							echo '<label for="check-rang2">Сержант-майор сухопутных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший военфельдшер">';
							echo '<label for="check-rang1">Младший военфельдшер</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Военфельдшер">';
							echo '<label for="check-rang2">Военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Команд сержант-майор">';
							echo '<label for="check-rang1">Команд сержант-майор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Сержант-майор воздушных войск">';
							echo '<label for="check-rang2">Сержант-майор воздушных войск</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Мл. офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший лейтенант">';
							echo '<label for="check-rang1">Младший лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант">';
							echo '<label for="check-rang2">Лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Старший военфельдшер">';
							echo '<label for="check-rang1">Старший военфельдшер</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Прапорщик">';
							echo '<label for="check-rang1">Прапорщик</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Младший лейтенант">';
							echo '<label for="check-rang2">Младший лейтенант</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Бригадир">';
							echo '<label for="check-rang1">Бригадир</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Инструктора") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Младший инструктор">';
							echo '<label for="check-rang1">Младший инструктор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					} else if ($user['bigrang'] == "Офицерский состав") {
						if ($user['legion'] == "Гвардия" or $user['legion'] == "Солдат-клон" or $user['legion'] == "212" or $user['legion'] == "41" or $user['legion'] == "501") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Капитан">';
							echo '<label for="check-rang1">Капитан</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Майор">';
							echo '<label for="check-rang2">Майор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Подполковник">';
							echo '<label for="check-rang3">Подполковник</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Полковник">';
							echo '<label for="check-rang4">Полковник</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Медик") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Полевой врач">';
							echo '<label for="check-rang1">Полевой врач</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Врач">';
							echo '<label for="check-rang2">Врач</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Хирург">';
							echo '<label for="check-rang3">Хирург</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Военный хирург">';
							echo '<label for="check-rang4">Военный хирург</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ИПК") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант">';
							echo '<label for="check-rang1">Лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант-коммандер">';
							echo '<label for="check-rang2">Лейтенант-коммандер</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Командир">';
							echo '<label for="check-rang3">Командир</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Капитан">';
							echo '<label for="check-rang4">Капитан</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "ОДИСБ") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Лейтенант">';
							echo '<label for="check-rang1">Лейтенант</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Лейтенант-коммандер">';
							echo '<label for="check-rang2">Лейтенант-коммандер</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Командир">';
							echo '<label for="check-rang3">Командир</label>';
							
							echo '<input type="checkbox" id="check-rang4" name="rang" value="Капитан">';
							echo '<label for="check-rang4">Капитан</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} else if ($user['legion'] == "Инструктора") {
							echo '<form method="post" action="profile" class ="form-inp" style="flex-direction:column;">';
							
							echo '<div style="display:flex;flex-direction:column;text-align:center;">';
							echo '<div style="font-size:30px;border:2px solid white;padding:20px;background-color:black;">Выберите звание</div>';
							
							echo '<input type="checkbox" id="check-rang1" name="rang" value="Инструктор">';
							echo '<label for="check-rang1">Инструктор</label>';
							
							echo '<input type="checkbox" id="check-rang2" name="rang" value="Старший инструктор">';
							echo '<label for="check-rang2">Старший инструктор</label>';
							
							echo '<input type="checkbox" id="check-rang3" name="rang" value="Оперативный инструктор">';
							echo '<label for="check-rang3">Оперативный инструктор</label>';
							
							echo '</div>';
							echo '<div>';
								echo '<button class ="btn-reg" type="submit" name ="save">Сохранить</button>';
							echo '</div>';
							saverang();
							
							echo '</form>';
						} 
					}
				}
			?>
			</div>
		</div>
	</div>
	<?php else : ?>
			</div>
		</div>
	<?php endif; ?>
	<?php else : ?>
		<div class ="content">
			<?php echo '<div class ="alert-box"> Для начала войдите в аккаунт! </div>'; ?>
		</div>
	<?php endif; ?>

<?php 
require __DIR__ . '/footer.php'; 
?>