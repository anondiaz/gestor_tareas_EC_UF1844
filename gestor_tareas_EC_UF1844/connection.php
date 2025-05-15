<?php

// Seleccionaremos la conexión en función de la ubicación
require_once 'connection1.php'; // 172.16.20.0/24 IP CIEF
// require_once 'connection2.php'; // 10.10.10.0/24 IP CASA 1
// require_once 'connection3.php'; // 10.10.10.0/24 IP CASA 2

// Obtenemos la ip del servidor, pero es localhost ipv6 :(
// En otro momento ya profundizaremos en este tema
// $server_ip = $_SERVER['SERVER_ADDR'] ?? gethostbyname(gethostname());

// // Vamos a crear un array con los entornos y las redes en formato cidr
// $entornos = [
//     'cief'  => '172.16.20.0/24',  // La red de CIEF
//     'casa1' => '10.10.10.0/24',     // La red en mi casa
//     'casa2' => '192.168.10.0/24', // Por si aca
// ];

// echo "<br>"."--------------------"."<br>";
// echo $server_ip;
// echo "<br>"."--------------------"."<br>";
// print_r($entornos);
// echo "<br>"."--------------------"."<br>";

