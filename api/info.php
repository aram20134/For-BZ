<?
require "../db.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$online = R::getAssoc('SELECT * FROM bz2');
echo json_encode($online);