<?php

require_once 'connection.php';

// echo "Soy delete.php";
// echo "<br>"."--------------------"."<br>";
// Nos devuelve el numero del id del enlace que apunta a esta pagina
// es decir resuelve la variable que se encuentra allí y es lo que nos retorna
// echo $_GET['id'];
// echo "<br>"."--------------------"."<br>";

// Definir la querie como string
$update = "UPDATE tareas SET borrada = ? WHERE id_tarea = ? ";

// Preparación, '->' con espacios antes y después opcional
$updatePreparacion = $conn -> prepare($update);

//Ejecución, '->' con espacios antes y después opcional
$updatePreparacion -> execute([1, $_POST['id']]);

// Limpiamos el insert
$updatePreparacion = null;

// Cerramos la conexión
$conn = null;

// Recargamos la pagina index.php
header('location:index.php');