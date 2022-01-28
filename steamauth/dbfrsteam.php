<?php
// Подключаем библиотеку RedBeanPHP
require "libs/rb.php";

// Подключаемся к БД
R::setup( 'mysql:host=localhost;dbname=cr94782_swrp',
        'cr94782_swrp', 'Vardanyan20134' );

// Проверка подключения к БД
if(!R::testConnection()) die('No DB connection!');
session_start();
?>