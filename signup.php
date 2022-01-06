<?php
$title="[SWRP] Регистрация";
require "db.php";
require __DIR__ . '/header.php';
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

<div class ="content">
	<div style="display:flex; justify-content:center;">
		<div class="alert-box">
			<p>
				<strong>ВНИМАНИЕ!</strong>
				<br>
				Вводите свои настоящие данные, указанные на сервере! Иначе вы создадите проблем всем пользователям. В таком случае ваш аккаунт может быть удален.
			</p>
		</div>
	</div>
	<div class ="reg">
		<h1 class ="online-head" style="margin-bottom:20px; margin-top:0px;">РЕГИСТРАЦИЯ</h1>
	<form action="signup" method="post" class ="form-inp">
		<div style="display: flex;flex-direction: column;">
			<input type="text" class="inp" name="number" placeholder="Введите ваш номер">
			<p>Номер сменить будет нельзя!</p>
			<input type="text" class="inp" name="name" placeholder="Введите ваш позывной">
			<p>Позывной можно будет сменить в любое время.</p>
			<input type="password" class="inp" name="password" placeholder="Введите пароль">
			<input type="password" class="inp" name="password2" placeholder="Повторите пароль">
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
				<button class="btn-reg" name="do_signup" type="submit">Зарегистрироватьcя</button>
			</div>
		</div>
		<?php 
	$data = $_POST;
	
	if(isset($data['do_signup'])) {
		$errors = array();
		
		if(trim($data['number']) == '') {
			$errors[] = 'Введите номер!';
		}
		if(trim($data['name']) == '') {
			$errors[] = 'Введите позывной!';
		}
		if(trim($data['password']) == '') {
			$errors[] = 'Введите пароль!';
		}
		if($data['phase1'] == '' and $data['phase2'] == '') {
			$errors[] = 'Выберите фазу!';
		}
		if($data['password2'] != $data['password']) {
			$errors[] = 'Пароли не совпадают!';
		}
		
		if (mb_strlen($data['number']) < 4 || mb_strlen($data['number']) > 5) {
			$errors[] = 'Номер может быть только 4-ех или 5-и значным!';
		}
		if (mb_strlen($data['name']) > 15) {
			$errors[] = 'Позывной не может быть таким длинным!';
		}
		if (R::count('usersbz', "number = ?", array($data['number'])) > 0) {
			$errors[] = 'Пользователь с таким номером уже существует!';
		}
		if (empty($errors)) {
			$user = R::dispense('usersbz');

			$user->number = $data['number'];
			$user->name = $data['name'];
			if ($data['phase1'] == "on") {
				$user->phase = "1";
			} else {
				$user->phase = "2";
			}
			$user->password = $data['password'];
			$user->legion = "0";
			$user->rang = "0";
			$user->steamid = "0";
			
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			
			R::store($user);
			echo '<div class="scs-box">Вы успешно зарегистрированы!</div>';
		} else {
			echo '<div class="alert-box" style="margin:10px;"><p>'. array_shift($errors).'</p></div>';
		}
	}
?>
	</form>
	
	</div>
</div>

<?php 
require __DIR__ . '/footer.php'; 
?>