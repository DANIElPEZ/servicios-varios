<?php
//production
/*
$host = 'sql201.infinityfree.com';
$username = 'if0_37668365';
$password = 'ZkQX1OgLB3etzqC';
$database = 'if0_37668365_servicios_varios';
*/
//localhost

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'servicios_varios';

$conn = new mysqli($host, $username, $password, $database);