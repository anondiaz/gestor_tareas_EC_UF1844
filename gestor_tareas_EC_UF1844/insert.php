<?php

// require_once 'connection.php';
require_once 'connection2.php';
// require_once 'connection3.php';
// require_once 'traduccion_colores.php';

echo "Soy insert.php";
echo "<br>"."--------------------"."<br>";
print_r($_POST); // No muestra los datos en la barra de navegacion
echo "<br>"."--------------------"."<br>";
// print_r($_GET); // Muestra los datos en la barra de navegacion
echo $_POST['titulo'];
echo "<br>"."--------------------"."<br>";
echo $_POST['descripcion'];
echo "<br>"."--------------------"."<br>";

// Definir la querie como string
$insert = "INSERT INTO tareas(titulo, descripcion, estado) VALUES (?, ?, ?)";

// Preparación, '->' con espacios antes y después opcional
$insertPreparacion = $conn -> prepare($insert);

//Ejecución, '->' con espacios antes y después opcional
// $insertPreparacion -> execute([$_POST['titulo'], $_POST['descripcion'], "Pendiente"]);

// Limpiamos el insert
$insertPreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
// header('location:index.php');