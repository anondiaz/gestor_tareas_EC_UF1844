<?php

// require_once 'connection.php';
require_once 'connection2.php';
// require_once 'connection3.php';

// Nos devuelve el numero del id del enlace que apunta a esta pagina
// es decir resuelve la variable que se encuentra allí y es lo que nos retorna
// echo $_GET['id'];

// Definir la querie como string
$delete = "DELETE FROM colores WHERE id_color = ?";

// Preparación, '->' con espacios antes y después opcional
$deletePreparacion = $conn -> prepare($delete);

//Ejecución, '->' con espacios antes y después opcional
$deletePreparacion -> execute([$_GET['id']]);

// Limpiamos el delete
$deletePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');