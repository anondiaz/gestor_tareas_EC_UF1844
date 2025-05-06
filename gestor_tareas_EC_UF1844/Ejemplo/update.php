<?php

// require_once 'connection.php';
require_once 'connection2.php';
// require_once 'connection3.php';
require_once 'traduccion_colores.php';

// print_r($_POST);

// Definir la querie como string
$update = "UPDATE colores SET color = ?, usuario = ? WHERE id_color = ? ";

// Preparación, '->' con espacios antes y después opcional
$updatePreparacion = $conn -> prepare($update);

//Ejecución, '->' con espacios antes y después opcional
$updatePreparacion -> execute([$arrayColors[$_POST['color']], $_POST['usuario'], $_POST['id']]);

// Limpiamos el insert
$updatePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');