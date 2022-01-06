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
include "/steam_auth.php";
?>
<script src="jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		
		var phase = "<?php echo $_SESSION['logged_user']->phase ?>";
		
		if (phase == "1") {
			$('#phase2').addClass('not-active')
			$('.choice1').click(function(){
			$('.ch-leg').toggleClass('active-l');
			console.log("Phase 1");
		});
		$('.ch-leg li').click(function (){
			$('input[name=legion]').val(this.value);
			var leg = $('input[name=legion]').val();
			
			let legion = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Тренера", "Гвардия"];
			let rang = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Клон коммандер", "Клон маршал"];
			let pil = ["Пилот-рекрут", "Пилот", "Старшина", "Сержант", "Первый сержант", "Сержант-майор воздушных войск", "Прапорщик", "Лейтенант флота", "Лейтенант-коммандер", "Коммандер", "Капитан 3 класса", "Капитан 2 класса", "Капитан 1 класса", "Адмирал флота"];
			let odisb = ["Осужденный", "Стажер", "Смотритель", "Оперативник", "Старший оперативник", "Дознаватель", "Руководитель", "Заместитель начальника", "Начальник"];
			let med = ["Интерн", "Практикант", "Ординатор", "Старший ординатор", "Военфельдшер", "Старший военфельдшер", "Врач", "Полевой врач", "Хирург", "Главный хирург", "Главврач", "Военврач 3-го ранга", "Военврач 2-го ранга", "Военврач 1-го ранга"];
			let tren = ["Контрактный тренер", "Тренер-практикант", "Тренер", "Старший тренер", "Тренер спец. назнния", "Мандалорский тренер"];
			$('.choice1').text(legion[leg]);
			
			if(leg == "0" || leg == "1" || leg == "2" || leg == "3" || leg == "8") {
				$('.choice2').addClass('active-ul');
				$('.choice3').removeClass('active-ul');
				$('.choice4').removeClass('active-ul');
				$('.choice5').removeClass('active-ul');
				$('.choice6').removeClass('active-ul');
				$('.choice2').click(function(){
					$('.ch-rang').toggleClass('active-ul');
				});
				$('.ch-rang li').click(function () {
					$('input[name=rang]').val(this.value);
					var rng = $('input[name=rang]').val();
					console.log(rng);
					$('.choice2').text(rang[rng]);
				});
			} else if (leg == "6") {
					$('.ch-pil li').click(function () {
						$('input[name=rang]').val(this.value);
						var rng = $('input[name=rang]').val();
						console.log(rng);
					$('.choice3').text(pil[rng]);
				});
				$('.choice2').removeClass('active-ul');
				$('.choice3').addClass('active-ul');
				$('.choice5').removeClass('active-ul');
				$('.choice4').removeClass('active-ul');
				$('.choice6').removeClass('active-ul');
				$('.choice3').click(function() {
					$('.ch-pil').toggleClass('active-ul');
				});
			} else if (leg == "5") {
					$('.ch-odisb li').click(function () {
						$('input[name=rang]').val(this.value);
						var rng = $('input[name=rang]').val();
						console.log(rng);
					$('.choice4').text(odisb[rng]);
				});
				$('.choice2').removeClass('active-ul');
				$('.choice3').removeClass('active-ul');
				$('.choice5').removeClass('active-ul');
				$('.choice6').removeClass('active-ul');
				$('.choice4').addClass('active-ul');
				$('.choice4').click(function() {
					$('.ch-odisb').toggleClass('active-ul');
				});
			} else if (leg == "4") {
					$('.ch-med li').click(function () {
						$('input[name=rang]').val(this.value);
						var rng = $('input[name=rang]').val();
						console.log(rng);
					$('.choice5').text(med[rng]);
				});
				$('.choice2').removeClass('active-ul');
				$('.choice3').removeClass('active-ul');
				$('.choice4').removeClass('active-ul');
				$('.choice6').removeClass('active-ul');
				$('.choice5').addClass('active-ul');
				$('.choice5').click(function() {
					$('.ch-med').toggleClass('active-ul');
				});
			} else if (leg == "7") {
					$('.ch-tren li').click(function () {
						$('input[name=rang]').val(this.value);
						var rng = $('input[name=rang]').val();
						console.log(rng);
					$('.choice6').text(tren[rng]);
				});
				$('.choice2').removeClass('active-ul');
				$('.choice3').removeClass('active-ul');
				$('.choice4').removeClass('active-ul');
				$('.choice5').removeClass('active-ul');
				$('.choice6').addClass('active-ul');
				$('.choice6').click(function() {
					$('.ch-tren').toggleClass('active-ul');
				});
			} else {
				$('.choice3').removeClass('active-ul');
				$('.choice2').removeClass('active-ul');
				$('.choice4').removeClass('active-ul');
				$('.choice5').removeClass('active-ul');
				$('.choice6').removeClass('active-ul');
			}
		});
		// СДЕЛАТЬ ВЫБОР ЗВАНИЯ И ЛЕГИОНА 2 ФАЗЫ!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		} else {
			$('#phase1').addClass('not-active')
		}
	});
</script>
<?php if(isset($_SESSION['logged_user'])) : ?>
	<div class ="content">
		<div class="num-name"><img style="margin:10px;height:100px;" src="<?php echo $_SESSION['steam_avatarfull']?>"  /><?php echo $_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name  ?> </div>
		
		<div class="prof-info">
			<h1 style="display:flex;justify-content:center;">Информация</h1>
			<div class ="text-prof">
				<p>
				Ваш номер: <?php echo $_SESSION['logged_user']->number ?>
				<br>
				Ваш позывной: <?php echo $_SESSION['logged_user']->name ?>
				<br>
				Фаза: <?php echo $_SESSION['logged_user']->phase; ?>
				<br>
				Steam: <?php
					$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
					if ($user['steamid']) {
							require 'steamauth/userInfo.php';
							echo '<span class = "find">Подключено</span>';
							echo '<a href="steamauth/logout.php" style="color:white;text-decoration:underline;">(Выйти)</a>';
							
						} elseif (isset($_SESSION['steamid'])) {
							$user-> $_SESSION['steamid'];
						} else {
							loginButton();
						}
						
						R::store($user);
						
						?>
					
				<span data="Подключите Steam аккаунт, чтобы вы и другие пользователи могли видеть ваш НПЗ и легион в списке игроков фашей фазы."><img src="img/info.png" class="ico-info" data ="123"/></span>
				<br>
				Discord: Не подключен <span data="Подключите Discord аккаунт, чтобы подтвердить вашу личность."><img src="img/info.png" class="ico-info"/></span>
				
				<br><br>
				Легион: <?php $l = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
					if ($l['legion'] == "501") {
						echo '<span class="leg501">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "212") {
						echo '<span class="leg212">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "41") {
						echo '<span class="leg41">'. $l['legion'] . '</span>'; 
					} else if ($l['legion'] == "CT") {
						echo '<span class="legCT">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "Гвардия") {
						echo '<span class="legGVARD">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "ИПК") {
						echo '<span class="legIPK">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "ОДИСБ") {
						echo '<span class="legODISB">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "Медик") {
						echo '<span class="legMED">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "Тренера") {
						echo '<span class="legTREN">'. $l['legion'] . '</span>';
					} else if ($l['legion'] == "(NULL)") {
						echo '<span class="N">Отсутствует</span>';
					} else {
						echo '<span class="N">Отсутствует</span>';
					}
				?>
				<br><br>
				Звание: <?php
				if ($l['legion'] == "501" or $l['legion'] == "41" or $l['legion'] == "CT" or $l['legion'] == "Гвардия" or $l['legion'] == "212") {
					for ($i = 0; $i <= "21"; $i++) {
						if ($rang[$i] == $l['rang']) {
							if ($i <= "4") {
								echo '<span class="R">'. $l['rang'] . '</span>';
							} elseif ($i >= "5" and $i <= "11") {
								echo '<span class="S">'. $l['rang'] . '</span>';
							} elseif ($i == "12" or $i == "13") {
								echo '<span class="MO">'. $l['rang'] . '</span>';
							} elseif ($i >= "14" and $i <= "17") {
								echo '<span class="O">'. $l['rang'] . '</span>';
							} elseif ($i >= "18" and $i <= "21") {
								echo '<span class="K">'. $l['rang'] . '</span>';
							} else {
								echo 'Ошибка';
							}
						}
					}
				} else if ($l['legion'] == "ИПК") {
					for ($i = 0; $i <= 13; $i++) {
						if($pil[$i] == $l['rang']) {
							if ($i <= "3") {
								echo '<span class="R">'. $l['rang'] . '</span>';
							} elseif ($i >= "3" and $i <= "5") {
								echo '<span class="S">'. $l['rang'] . '</span>';
							} elseif ($i == "6" or $i == "7") {
								echo '<span class="MO">'. $l['rang'] . '</span>';
							} elseif ($i == "8" or $i == "9") {
								echo '<span class="O">'. $l['rang'] . '</span>';
							} elseif ($i >= "10" and $i <= "13") {
								echo '<span class="K">'. $l['rang'] . '</span>';
							} else {
								echo 'Ошибка';
							}
						}
					}
				} else if ($l['legion'] == "ОДИСБ") {
					for ($i = 0; $i <=8; $i++) {
						if($ODISB[$i] == $l['rang']) {
							if ($i <= "1" or $i == "2") {
								echo '<span class="R">'. $l['rang'] . '</span>';
							} elseif ($i == "3" or $i == "4") {
								echo '<span class="S">'. $l['rang'] . '</span>';
							} elseif ($i == "5") {
								echo '<span class="MO">'. $l['rang'] . '</span>';
							} elseif ($i == "6") {
								echo '<span class="O">'. $l['rang'] . '</span>';
							} elseif ($i >= "7") {
								echo '<span class="K">'. $l['rang'] . '</span>';
							}
						}
					}
				} else if ($l['legion'] == "Медик") {
					for ($i = 0; $i <= 13; $i++) {
						if($med[$i] == $l['rang']) {
							if ($i == "0" or $i == "1") {
								echo '<span class="R">'. $l['rang'] . '</span>';
							} elseif ($i == "2" or $i == "3") {
								echo '<span class="S">'. $l['rang'] . '</span>';
							} elseif ($i == "4" or $i == "5") {
								echo '<span class="MO">'. $l['rang'] . '</span>';
							} elseif ($i >= "6" and $i <= "8") {
								echo '<span class="O">'. $l['rang'] . '</span>';
							} elseif ($i >= "9") {
								echo '<span class="K">'. $l['rang'] . '</span>';
							}
						}
					}
				} else if ($l['legion'] == "Тренера") {
					for ($i = 0; $i < 13; $i++) {
						if($tren[$i] == $l['rang']) {
							if ($i == "0" or $i == "1") {
								echo '<span class="S">'. $l['rang'] . '</span>';
							} elseif ($i == "2" or $i == "3") {
								echo '<span class="MO">'. $l['rang'] . '</span>';
							} elseif ($i == "4") {
								echo '<span class="O">'. $l['rang'] . '</span>';
							} elseif ($i == "5") {
								echo '<span class="K">'. $l['rang'] . '</span>';
							}
						}
					}
				} else if ($l['legion'] == "(NULL)") {
					echo '<span class="E">Советник</span>';
				}
						if ($l['rang'] == "") {
							echo '<span class="N">Отсутствует</span>';
						}
						
			?>
			
				</p>
			
			</div>
			<h1 style="display:flex;justify-content:center;text-align:center;">Укажите свои данные на SWRP Phase <?php echo $_SESSION['logged_user']->phase ?></h1>
			<div class ="alert-box" style="max-width:100%;">
				<p>
					Указывайте свои настоящие данные! Иначе ваш аккаунт может быть удалён!
				</p>
			</div>
			<div class="text-prof">
					<form action="profile" method="post" class ="form-inp" style="justify-content:center;">
						<nav id = "phase2">
						<ul>
							<li class ="choice1">Выберите подразделение</li>
							<ul class ="ch-leg">
								<li value="0">CT</li>
								<li value="1">41</li>
								<li value="2">212</li>
								<li value="3">501</li>
								<li value="4">Медик</li>
								<li value="5">ОДИСБ</li>
								<li value="6">ИПК</li>
								<li value="7">Тренера</li>
								<li value="8">Гвардия</li>
							</ul>
						</ul>
						<ul>
							<li class ="choice2">Выберите звание</li>
							<ul class ="ch-rang">
								<li value="0">Рядовой-рекрут</li>
								<li value="1">Рядовой</li>
								<li value="2">Рядовой первого класса</li>
								<li value="3">Специалист</li>
								<li value="4">Капрал</li>
								<li value="5">Сержант</li>
								<li value="6">Штаб-сержант</li>
								<li value="7">Сержант первого класса</li>
								<li value="8">Первый сержант</li>
								<li value="9">Сержант-майор</li>
								<li value="10">Команд сержант-майор</li>
								<li value="11">Сержант-майор сухопутных войск</li>
								<li value="12">Мл. Лейтенант</li>
								<li value="13">Лейтенант</li>
								<li value="14">Капитан</li>
								<li value="15">Майор</li>
								<li value="16">Подполковник</li>
								<li value="17">Полковник</li>
								<li value="18">Командир</li>
								<li value="19">Командир первого класса</li>
								<li value="20">Коммандер</li>
								<li value="21">Маршал-коммандер</li>
							</ul>
							<li class ="choice3">Выберите звание</li>
							<ul class ="ch-pil">
								<li value="0">Пилот-рекрут</li>
								<li value="1">Пилот</li>
								<li value="2">Старшина</li>
								<li value="3">Сержант</li>
								<li value="4">Первый сержант</li>
								<li value="5">Сержант-майор воздушных войск</li>
								<li value="6">Прапорщик</li>
								<li value="7">Лейтенант флота</li>
								<li value="8">Лейтенант-коммандер</li>
								<li value="9">Коммандер</li>
								<li value="10">Капитан 3 класса</li>
								<li value="11">Капитан 2 класса</li>
								<li value="12">Капитан 1 класса</li>
								<li value="13">Адмирал флота</li>
							</ul>
							<li class ="choice4">Выберите звание</li>
							<ul class ="ch-odisb">
								<li value="0">Осужденный</li>
								<li value="1">Стажер</li>
								<li value="2">Смотритель</li>
								<li value="3">Оперативник</li>
								<li value="4">Старший оператинвик</li>
								<li value="5">Дознаватель</li>
								<li value="6">Руководитель</li>
								<li value="7">Заместитель начальника</li>
								<li value="8">Начальник</li>
							</ul>
							<li class ="choice5">Выберите звание</li>
							<ul class ="ch-med">
								<li value="0">Интерн</li>
								<li value="1">Практикант</li>
								<li value="2">Ординатор</li>
								<li value="3">Старший ординатор</li>
								<li value="4">Военфельдшер</li>
								<li value="5">Старший военфельдшер</li>
								<li value="6">Врач</li>
								<li value="7">Полевой врач</li>
								<li value="8">Хирург</li>
								<li value="9">Военный хирург</li>
								<li value="10">Главврач</li>
								<li value="11">Военврач 3-го ранга</li>
								<li value="12">Военврач 2-го ранга</li>
								<li value="13">Военврач 1-го ранга</li>
							</ul>
							<li class ="choice6">Выберите звание</li>
							<ul class ="ch-tren">
								<li value="0">Контрактный тренер</li>
								<li value="1">Тренер-практикант</li>
								<li value="2">Тренер</li>
								<li value="3">Старший тренер</li>
								<li value="4">Тренер спец. назначения</li>
								<li value="5">Мандалорский тренер</li>
							</ul>
						</ul>
						</nav>
						<nav id = "phase1">
						<ul>
							<li class ="choice1">Выберите подразделение</li>
							<ul class ="ch-leg">
								<li value="0">CT</li>
								<li value="1">41</li>
								<li value="2">212</li>
								<li value="3">501</li>
								<li value="4">Медик</li>
								<li value="5">ОДИСБ</li>
								<li value="6">ИПК</li>
								<li value="7">Тренера</li>
								<li value="8">Гвардия</li>
							</ul>
						</ul>
						<ul>
							<li class ="choice2">Выберите звание</li>
							<ul class ="ch-rang">
								<li value="0">Рядовой-рекрут</li>
								<li value="1">Рядовой</li>
								<li value="2">Рядовой первого класса</li>
								<li value="3">Специалист</li>
								<li value="4">Капрал</li>
								<li value="5">Сержант</li>
								<li value="6">Штаб-сержант</li>
								<li value="7">Сержант первого класса</li>
								<li value="8">Первый сержант</li>
								<li value="9">Сержант-майор</li>
								<li value="10">Команд сержант-майор</li>
								<li value="11">Сержант-майор сухопутных войск</li>
								<li value="12">Мл. Лейтенант</li>
								<li value="13">Лейтенант</li>
								<li value="14">Капитан</li>
								<li value="15">Майор</li>
								<li value="16">Подполковник</li>
								<li value="17">Полковник</li>
								<li value="18">Командир</li>
								<li value="19">Командир первого класса</li>
								<li value="20">Клон коммандер</li>
								<li value="21">Клон маршал</li>
							</ul>
							<li class ="choice3">Выберите звание</li>
							<ul class ="ch-pil">
								<li value="0">Пилот-рекрут</li>
								<li value="1">Пилот</li>
								<li value="2">Старшина</li>
								<li value="3">Сержант</li>
								<li value="4">Первый сержант</li>
								<li value="5">Сержант-майор воздушных войск</li>
								<li value="6">Прапорщик</li>
								<li value="7">Лейтенант флота</li>
								<li value="8">Лейтенант-коммандер</li>
								<li value="9">Коммандер</li>
								<li value="10">Капитан 3 класса</li>
								<li value="11">Капитан 2 класса</li>
								<li value="12">Капитан 1 класса</li>
								<li value="13">Адмирал флота</li>
							</ul>
							<li class ="choice4">Выберите звание</li>
							<ul class ="ch-odisb">
								<li value="0">Осужденный</li>
								<li value="1">Стажер</li>
								<li value="2">Смотритель</li>
								<li value="3">Оперативник</li>
								<li value="4">Старший оператинвик</li>
								<li value="5">Дознаватель</li>
								<li value="6">Руководитель</li>
								<li value="7">Заместитель начальника</li>
								<li value="8">Начальник</li>
							</ul>
							<li class ="choice5">Выберите звание</li>
							<ul class ="ch-med">
								<li value="0">Интерн</li>
								<li value="1">Практикант</li>
								<li value="2">Ординатор</li>
								<li value="3">Старший ординатор</li>
								<li value="4">Военфельдшер</li>
								<li value="5">Старший военфельдшер</li>
								<li value="6">Врач</li>
								<li value="7">Полевой врач</li>
								<li value="8">Хирург</li>
								<li value="9">Военный хирург</li>
								<li value="10">Главврач</li>
								<li value="11">Военврач 3-го ранга</li>
								<li value="12">Военврач 2-го ранга</li>
								<li value="13">Военврач 1-го ранга</li>
							</ul>
							<li class ="choice6">Выберите звание</li>
							<ul class ="ch-tren">
								<li value="0">Контрактный тренер</li>
								<li value="1">Тренер-практикант</li>
								<li value="2">Тренер</li>
								<li value="3">Старший тренер</li>
								<li value="4">Тренер спец. назначения</li>
								<li value="5">Мандалорский тренер</li>
							</ul>
						</ul>
						</nav>
						<input name="legion" type="text" style="display:none;">
						<input name="rang" type="text" style="display:none;">
					<div style="display: flex;justify-content: center;width: 100%;">
						<div>
							<button class ="btn-reg" type="submit" name ="save">Сохранить</button>
						</div>
					</div>
					<?php 
					$data = $_POST;
						
						
						if(isset($data['save'])) {
							$errors = array();
							
							if(trim($data['legion']) == "") {
								$errors[] = 'Выберите легион!';
							}
							if(trim($data['rang']) == "") {
								$errors[] = 'Выберите звание!';
							}
							if(empty($errors)) {
								
								if ($data['legion'] == "0" || $data['legion'] == "1" || $data['legion'] == "2" || $data['legion'] == "3" || $data['legion'] == "8") {
									$data['legion'] = $legion[$data['legion']];
									$data['rang'] = $rang[$data['rang']];	
								}
								if ($data['legion'] == "6") {
									$data['legion'] = $legion[$data['legion']];
									$data['rang'] = $pil[$data['rang']];
								}
								if ($data['legion'] == "5") {
									$data['legion'] = $legion[$data['legion']];
									$data['rang'] = $ODISB[$data['rang']];
								}
								if ($data['legion'] == "4") {
									$data['legion'] = $legion[$data['legion']];
									$data['rang'] = $med[$data['rang']];
								}
								if ($data['legion'] == "7") {
									$data['legion'] = $legion[$data['legion']];
									$data['rang'] = $tren[$data['rang']];
								}
								if (R::count('usersbz', "number = ?", array($_SESSION['logged_user']->number)) > 0) {
									$user = R::dispense('usersbz');
									$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
									$user->legion = $data['legion'];
									$user->rang = $data['rang'];	
								} else {
									$user = R::dispense('usersbz');
									$user->number = $_SESSION['logged_user']->number;
									$user->legion = $data['legion'];
									$user->rang = $data['rang'];	
								}
								R::store($user);
								header('Location:https://swrpngg.space/profile');
								
								echo '<div class="scs-box">Данные успешно изменены!</div>';
							} else {
								echo '<div class="alert-box" style="margin:10px;"><p>'. array_shift($errors).'</p></div>';
							}
						}
					?>
					</form>
			</div>
		</div>
	</div>
	<?php else : ?>
		<div class ="content">
			<?php echo '<div class ="alert-box"> Для начала войдите в аккаунт! </div>'; ?>
		</div>
	<?php endif; ?>

<?php 
require __DIR__ . '/footer.php'; 
?>