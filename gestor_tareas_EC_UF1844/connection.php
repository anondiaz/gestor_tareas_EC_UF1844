<?php

// Conexión a BBDD MySQL mediante PDO

// $server_name = "127.0.0.1";
// $server_name = "localhost";
// $bbdd = "tareas_andres_diaz";
// $port = 3306;
// $user = "root";
// $password = "";

$server_name = "localhost";
$bbdd = "tareas_andres_diaz";
$port = 3307;
$user = "root";
$password = "CIEF1234";

try {

    $conn = new PDO ("mysql:host=$server_name;port=$port;dbname=$bbdd", $user, $password);

    // echo "¡Conectados a $server_name $bbdd !<br>";

    // foreach ($conn -> query('SELECT * FROM colores') as $fila) {
    // print_r($fila);
    // echo "<br>";
    // echo $fila['usuario'];
    // }

} catch (PDOException $err) { // Mostrar el error de conexión
    
    echo "Error $err";

}

