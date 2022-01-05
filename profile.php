<?php
$title="[SWRP] Профиль";
require "db.php";
require __DIR__ . '/header.php';
?>
<script src="jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$('.choice1').click(function(){
			$('.ch-leg').toggleClass('active-l');
			console.log("SD");
		});
		$('.ch-leg li').click(function (){
			$('input[name=legion]').val(this.value);
			var leg = $('input[name=legion]').val();
			
			let legion = ["CT", "41", "212", "501", "Медик", "ОДИСБ", "ИПК", "Тренера", "Гвардия"];
			let rang = ["Рядовой-рекрут", "Рядовой", "Рядовой первого класса", "Специалист", "Капрал", "Сержант", "Штаб-сержант", "Сержант первого класса", "Первый сержант", "Сержант-майор", "Команд сержант-майор", "Сержант-майор сухопутных войска", "Мл. Лейтенант", "Лейтенант", "Капитан", "Майор", "Подполковник", "Полковник", "Командир", "Командир первого класса", "Клон коммандер", "Клон маршал"];
			
			$('.choice1').text(legion[leg]);
			
			if(leg == "0" || leg == "1" || leg == "2" || leg == "3" || leg == "8") {
				$('.choice2').addClass('active-ul');
				$('.choice2').click(function(){
					$('.ch-rang').toggleClass('active-ul');
				});
				$('.ch-rang li').click(function () {
					$('input[name=rang]').val(this.value);
					var rng = $('input[name=rang]').val();
					console.log(rng);
					$('.choice2').text(rang[rng]);
				});
			} else {
				$('.choice2').removeClass('active-ul');
			}
		});
	});
</script>
<?php if(isset($_SESSION['logged_user'])) : ?>
	<div class ="content">
		<div class="num-name"><?php echo $_SESSION['logged_user']->number.$a.$_SESSION['logged_user']->name  ?> </div>
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
				Steam: Не подключен <span data="Подключите Steam аккаунт, чтобы вы и другие пользователи могли видеть ваш НПЗ и легион в списке игроков фашей фазы."><img src="img/info.png" class="ico-info" data ="123"/></span>
				<br>
				Discord: Не подключен <span data="Подключите Discord аккаунт, чтобы подтвердить вашу личность."><img src="img/info.png" class="ico-info"/></span>
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
						<nav>
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
								$user2 = R::dispense('number', $_SESSION['logged_user']->number);
								
								$user2->legion = $data['legion'];
								$user2->rang = $data['rang'];
								
								R::store($user2);
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