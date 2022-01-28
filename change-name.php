<?php
$title="[SWRP] Смена позывного";
require "db.php";
require __DIR__ . '/header.php';
?>
<div class = "content">
	<?php if($_SESSION['logged_user'] != NULL) : ?>
	
		<div class ="reg">
			<h1 class ="online-head" style="margin-bottom:20px; margin-top:0px;">Смена позывного</h1>
			<form action="change-name" method="post" class ="form-inp">
		<div style="display: flex;flex-direction: column;">
			<input type="text" class="inp" name="name" placeholder="Введите новый позывной">
		</div>
		<div style="display: flex;justify-content: center;width: 100%;">
			<div>
				<button class="btn-reg" name="change_name" type="submit">Сменить позывной</button>
			</div>
		</div>
		<?php 
	$data = $_POST;
	
	if(isset($data['change_name'])) {
		$errors = array();
		
		if(trim($data['name']) == '') {
			$errors[] = 'Введите позывной!';
		} 
		if (mb_strlen($data['name']) > 15) {
			$errors[] = 'Позывной не может быть таким длинным!';
		}
		if (empty($errors)) {
			$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
			$user->name = $data['name'];
			
			R::store($user);
			header('Location: https://swrpngg.space/profile');
			echo '<div class="scs-box">Позывной успешно сменён!</div>';
		} else {
			echo '<div class="alert-box" style="margin:10px;"><p>'. array_shift($errors).'</p></div>';
		}
	}
?>
	</form>
		</div>
		
		<?php else : ?>
		<div class ="alert-box">Для смены позывного войдите в аккаунт!</div>
	<?php endif; ?>
</div>


<?php 
require __DIR__ . '/footer.php'; 
?>