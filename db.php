<?php
require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=u1596497_default',
        'u1596497_default', 'sfFysYg4G1zXV0X1' );

if(!R::testConnection()) die('No DB connection!');
session_start();
?>