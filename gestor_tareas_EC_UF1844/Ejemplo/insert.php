<?php

// require_once 'connection.php';
require_once 'connection2.php';
// require_once 'connection3.php';
require_once 'traduccion_colores.php';

// echo "Soy insert.php";

// print_r($_POST); // No muestra los datos en la barra de navegacion
// print_r($_GET); // Muestra los datos en la barra de navegacion
// echo $_POST['usuario'];
// echo "<br>";
// echo $_POST['color'];

// Definir la querie como string
$insert = "INSERT INTO colores(color, usuario) VALUES (?, ?)";

// Preparación, '->' con espacios antes y después opcional
$insertPreparacion = $conn -> prepare($insert);

//Ejecución, '->' con espacios antes y después opcional
$insertPreparacion -> execute([$arrayColors[$_POST['color']], $_POST['usuario']]);

// Limpiamos el insert
$insertPreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');