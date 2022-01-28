<?php
require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=cr94782_swrp',
        'cr94782_swrp', 'Vardanyan20134' );

if(!R::testConnection()) die('No DB connection!');
session_start();
?>