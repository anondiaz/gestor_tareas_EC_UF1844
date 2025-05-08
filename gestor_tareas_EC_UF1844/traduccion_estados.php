<?php

// Aquí vamos a leer la tabla de estados para obtener el id
// La conexión será la de cada operación,  debemos llamarla después del connection.php

// Definir la querie como string
$select = "SELECT * FROM estados";

// Preparación, '->' con espacios antes y después opcional
$preparacion = $conn->prepare($select);

//Ejecución, '->' con espacios antes y después opcional
$preparacion->execute();

//Obtener los valores seleccionados
$arrayEstados = $preparacion->fetchAll();
