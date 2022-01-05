<?php 
require "db.php";
require __DIR__ . '/header.php';


unset($_SESSION['logged_user']);

header('Location: https://swrpngg.space/');

require __DIR__ . '/footer.php';
?>
