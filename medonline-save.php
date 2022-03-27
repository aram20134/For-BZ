<?
require "db.php";

// ПЕРВЫЙ СЕРВЕР
$url="http://83.234.136.125:3333/players";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=json_decode(curl_exec($ch), true);
curl_close($ch);

// ВТОРОЙ СЕРВЕР
$url2="http://83.234.136.125:3334/players2";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_URL,$url2);
$result2=json_decode(curl_exec($ch2), true);
curl_close($ch2);

$medbz = R::dispense('medbz');

$medbz->d = Date('d');
$medbz->m = Date('m');
$medbz->Y = Date('Y');
$medbz->phase = "1";
$medbz->online = $result['raw']['numplayers'];
R::store($medbz);

$medbz = R::dispense('medbz');

$medbz->d = Date('d');
$medbz->m = Date('m');
$medbz->Y = Date('Y');
$medbz->phase = "2";
$medbz->online = $result2['raw']['numplayers'];
R::store($medbz);

exit();