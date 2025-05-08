<?php

require_once 'connection.php';
require_once 'traduccion_estados.php';

$id_estado = 0;

// print_r($arrayEstados);

foreach ($arrayEstados as $id_estado => $estado) {
    if ($_POST['estado'] == $arrayEstados['estado']){
        $id_estado = $arrayEstados['id_estado'];
    }
}

// if (in_array($_POST['estado'], $arrayEstados['estado'])) {
//     $id_estado = $arrayEstados['id_estado'];
// }

// echo "<br>"."--------------------"."<br>";
// echo $_POST['estado'];
// echo "<br>"."--------------------"."<br>";
// echo $id_estado;
// echo "<br>"."--------------------"."<br>";
// echo "Soy update.php";
// echo "<br>"."--------------------"."<br>";
// print_r($_POST);
// echo "<br>"."--------------------"."<br>";
// echo $_POST['id'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['titulo'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['descripcion'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['estado'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['fechafin'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['horafin'];
// echo "<br>"."--------------------"."<br>";

$fechahorafin = "";

if ($_POST['fechafin'] == "") {
    $fechahorafin = null;
} else {
    if ($_POST['horafin'] != "") {
        $horafin = $_POST['horafin'];
    } else {
        $horafin = '23:59:59';
    }
$fechahorafin = $_POST['fechafin'] . " " . $horafin;
}


// $fechahorafin = $_POST['fechafin'] ." ". $_POST['horafin'];


// if ($_POST['horafin'] != "") {
//     $horafin = $_POST['horafin'] . ":59";
// } else {
//     $horafin = '23:59:59';
// }

// $fechahorafin = $_POST['fechafin'] . " " . $horafin;

// echo $fechahorafin;
// echo "<br>"."--------------------"."<br>";

// Definir la querie como string
$update = "UPDATE tareas SET titulo = ?, descripcion = ?, fecha_prevista_fin = ?, estado = ?, id_estado = ?, id_modificacion = ? WHERE id_tarea = ? ";

// Preparación, '->' con espacios antes y después opcional
$updatePreparacion = $conn -> prepare($update);

//Ejecución, '->' con espacios antes y después opcional
$updatePreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], $fechahorafin, $_POST['estado'], $id_estado, 0, $_POST['id']]);

// Limpiamos el insert
$updatePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');