<?php

require_once 'connection.php';
// require_once 'traduccion_estados.php';

// echo "Soy insert.php";
// echo "<br>"."--------------------"."<br>";
// print_r($_POST); // No muestra los datos en la barra de navegacion
// echo "<br>"."--------------------"."<br>";
// print_r($_GET); // Muestra los datos en la barra de navegacion

// print_r($arrayEstados);
// echo "<br>"."--------------------"."<br>";
// foreach ($arrayEstados as $id_estado => $estado ) {
//     echo $estado['id_estado']. " -> " .$estado['estado'];
//     echo "<br>"."--------------------"."<br>";
// }

if (isset($_POST['urgente'])) {
    $estado = 'Urgente';
    $id_estado = 1;
} else {
    $estado = 'Pendiente';
    $id_estado = 2;
}

if ($_POST['horafin'] != "") {
    $horafin = $_POST['horafin'] . ":00";
} else {
    $horafin = '23:59:00';
}

// echo $_POST['titulo'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['descripcion'];
// echo "<br>"."--------------------"."<br>";
// echo $estado;
// echo "<br>"."--------------------"."<br>";
// echo $id_estado;
// echo "<br>"."--------------------"."<br>";
// echo $_POST['fechafin'];
// echo "<br>"."--------------------"."<br>";
// echo $horafin;
// echo "<br>"."--------------------"."<br>";
$fechahorafin = $_POST['fechafin'] . " " . $horafin;
// echo $fechahorafin;
// echo "<br>"."--------------------"."<br>";



// TODO recoger el id_usuario e introducirlo en querie

// Definir la querie como string
$insert = "INSERT INTO tareas(titulo, descripcion, fecha_prevista_fin, id_estado, id_usuario, modificacion, borrada) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Preparación, '->' con espacios antes y después opcional
$insertPreparacion = $conn -> prepare($insert);

//Ejecución, '->' con espacios antes y después opcional
$insertPreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], $fechahorafin, $id_estado, 1, 0, 0]);

// Limpiamos el insert
$insertPreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');