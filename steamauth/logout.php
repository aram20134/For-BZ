<?php
	session_start();
	unset($_SESSION['steamid']);
	unset($_SESSION['steam_uptodate']);

	header("Location: ../index.php");
?>