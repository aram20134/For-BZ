<?php
$path = $_SERVER["DOCUMENT_ROOT"];
require $path . '/db.php';
ob_start();
?>
<?php
	unset($_SESSION['steamid']);
	unset($_SESSION['steam_uptodate']);
	
	$user = R::findOne('usersbz', 'number = ?', [$_SESSION['logged_user']->number]);
	
	$user->steamid = NULL;
	$user->avatar = NULL;
	$user->profurl = NULL;
	
	R::store($user);

	header('Location: https://swrpngg.space/profile');
?>