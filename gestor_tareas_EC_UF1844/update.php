<?php

require_once 'connection.php';
require_once 'traduccion_estados.php';

// print_r($arrayEstados);
// echo "<br>"."--------------------"."<br>";

// echo "<br>"."--------------------"."<br>";

// echo "<br>"."--------------------"."<br>";

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

// ----- Vamos a recuperar el id_estado -----
$id_estado = 0;

foreach ($arrayEstados as $id_subarrayestado) {
    // echo $id_subarrayestado['nombre_estado'] . "estado";
    // echo "<br>"."--------------------"."<br>";
    // echo $_POST['estado'] . "estado";
    // echo "<br>"."--------------------"."<br>";
    // echo $id_subarrayestado['id_estado'] . "id_estado";
    // echo "<br>"."--------------------"."<br>";

    if ($_POST['estado'] == $id_subarrayestado['nombre_estado']){
        $id_estado = $id_subarrayestado['id_estado'];
        // echo $id_estado;
        // echo "<br>"."--------------------"."<br>";
        // echo $id_subarrayestado['id_estado'];
        
    }
}

// echo $id_estado;
// echo $estado;

$fechahorafin = "";

if ($_POST['fechafin'] == "") {
    $fechahorafin = null;
} else {
    if ($_POST['horafin'] != "") {
        $horafin = $_POST['horafin'];
    } else {
        $horafin = '23:59:00';
    }
$fechahorafin = $_POST['fechafin'] . " " . $horafin;
}

// echo $_POST['titulo'];
// echo "<br>"."--------------------"."<br>";
// echo $_POST['descripcion'];
// echo "<br>"."--------------------"."<br>";
// echo $fechahorafin;
// echo "<br>"."--------------------"."<br>";
// echo $_POST['estado'];
// echo "<br>"."--------------------"."<br>";
// echo $id_estado;
// echo "<br>"."--------------------"."<br>";
// echo 1;
// echo "<br>"."--------------------"."<br>";
// echo $_POST['id'];
// echo "<br>"."--------------------"."<br>";


// $fechahorafin = $_POST['fechafin'] ." ". $_POST['horafin'];


// if ($_POST['horafin'] != "") {
//     $horafin = $_POST['horafin'] . ":59";
// } else {
//     $horafin = '23:59:59';
// }

// $fechahorafin = $_POST['fechafin'] . " " . $horafin;

// echo $fechahorafin;
// echo "<br>"."--------------------"."<br>";

// TODO recoger el id_usuario e introducirlo en querie

// Definir la querie como string
$update = "UPDATE tareas SET titulo = ?, descripcion = ?, fecha_prevista_fin = ?, id_estado = ?, id_usuario = ?, modificacion = ? WHERE id_tarea = ? ";

// Preparación, '->' con espacios antes y después opcional
$updatePreparacion = $conn -> prepare($update);

//Ejecución, '->' con espacios antes y después opcional
$updatePreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], $fechahorafin, $id_estado, 1, 1, $_POST['id']]);

// Limpiamos el insert
$updatePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');