<?php

require_once 'connection.php';
require_once 'traduccion_estados.php';

$id_estado = 0;

print_r($arrayEstados['id_estado']);

if (in_array($_POST['estado'], $arrayEstados)) {
    $id_estado = $arrayEstados['id_estado'];
}

echo $id_estado;

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

// Definir la querie como string
$update = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ? WHERE id_tarea = ? ";

// Preparación, '->' con espacios antes y después opcional
$updatePreparacion = $conn -> prepare($update);

//Ejecución, '->' con espacios antes y después opcional
// $updatePreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], $_POST['estado'], $_POST['id']]);

// Limpiamos el insert
// $updatePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
// header('location:index.php');