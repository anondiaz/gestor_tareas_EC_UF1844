<?php

require_once 'connection.php';
require_once 'traduccion_estados.php';

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
    $horafin = $_POST['horafin'] . ":59";
} else {
    $horafin = '23:59:59';
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




// Definir la querie como string
$insert = "INSERT INTO tareas(titulo, descripcion, fecha_prevista_fin, estado, id_estado, id_modificacion) VALUES (?, ?, ?, ?, ?, ?)";

// Preparación, '->' con espacios antes y después opcional
$insertPreparacion = $conn -> prepare($insert);

//Ejecución, '->' con espacios antes y después opcional
$insertPreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], $fechahorafin, $estado, $id_estado, 0]);

// Limpiamos el insert
$insertPreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');