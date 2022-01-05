<?php
$title="[SWRP] Вход";
require "db.php";
require __DIR__ . '/header.php';
?>
<?php
	if(isset($_SESSION['logged_user'])) {
		header('Location: https://swrpngg.space/');
		exit;
	}
?>
<script src="jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {
		$('#chk1').click(function () {
			$('#chk2').prop("checked", false);
		});
		$('#chk2').click(function () {
			$('#chk1').prop("checked", false);
		});
	});
</script>
<div class="content">
	<div class="reg">
		<h1 class ="online-head" style="margin-bottom:20px; margin-top:0px;">ВХОД</h1>
		<form action="login" method="post" class ="form-inp">
		<div style="display: flex;flex-direction: column;">
			<input type="text" class="inp" name="number" placeholder="Введите ваш номер">
			<input type="password" class="inp" name="password" placeholder="Введите пароль">
		</div>
		<div style="display:flex;justify-content:center;flex-direction:column;align-items:center;">
			<h1>Выберите фазу</h1>
			<ul class="phs">
				<li>
					<input type="checkbox" id="chk1" name="phase1"></input>
					<label for="chk1"><img src="img/phase1/clone1.png" class="ico-phs1" /></label>
				</li>
				<li>
					<input type="checkbox" id="chk2" name="phase2"></input>
					<label for="chk2"><img src="img/phase2/clone2.png" class="ico-phs2" /></label>
				</li>
			</ul>
		</div>
		<div style="display: flex;justify-content: center;width: 100%;">
			<div>
				<button class="btn-reg" name="do_login" type="submit">Войти</button>
			</div>
		</div>
		<?php 
			$data = $_POST;
			
			if(isset($data['do_login'])) {
				$errors = array();
				
				if(trim($data['number']) == '') {
					$errors[] = 'Введите номер!';
				}
				if(trim($data['password']) == '') {
					$errors[] = 'Введите пароль!';
				}
				if($data['phase1'] == " " or $data['phase2'] == " ") {
					$errors[] = 'Выберите фазу!';
				}
				if($data['phase1'] == "on") {
					$data['phase'] = "1";
				} elseif($data['phase2'] == "on") {
					$data['phase'] = "2";
				}
				if(!empty($errors)) {
					echo '<div class="alert-box"><p>'. array_shift($errors) . '</p></div>';
				}
				$user = R::findOne('usersbz', 'number= ?', array($data['number']));
				
				if ($user['number'] == $data['number']) {
					if($user['phase'] == $data['phase']) {
						if(password_verify($data['password'], $user->password)) {
						$_SESSION['logged_user'] = $user;
						// header('Location: https://swrpngg.space/');
						header('Location: https://swrpngg.space/');
						exit;
					} else {
						$errors[] = 'Пароль введен неверно!';
					}
					} else {
						$errors[] ='Пользователя с таким номером и фазой не существует!';
					}
				} else {
					$errors[] = 'Пользователя с таким номером не существует!';
				}
				
				if(!empty($errors)) {
					echo '<div class="alert-box"><p>'. array_shift($errors) . '</p></div>';
				}
			}
			
		?>
	</div>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>