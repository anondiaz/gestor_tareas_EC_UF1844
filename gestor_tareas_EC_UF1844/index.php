<?php

// Formas de llamar a un fichero en PHP, "introduce" el codigo en el punto donde se halle
// include 'nombre_fichero.php'; // Usar el error como un warning, no detendremos el script
// require 'nombre_fichero.php'; // Usar el error como crítico y detiene el script
// include_once 'nombre_fichero.php';  // Usar el error como un warning, no detendremos el script, solo realiza la conexión una vez
// require_once 'nombre_fichero.php'; // Usar el error como crítico y detiene el script, solo realiza la conexión una vez

// require_once 'connection.php';
require_once 'connection2.php';
// require_once 'connection3.php';
require_once 'traduccion_estados.php';
// echo "Soy el index.php";
// echo "<br>"."-----------------"."<br>";
// foreach ($conn -> query('SELECT * FROM colores') as $fila) {
//     print_r($fila);
//     echo "<br>";
//     echo $fila['usuario'];
//     echo "<br>";
// }
// echo "<br>"."-----------------"."<br>";

// Definir la querie como string
$select = "SELECT * FROM tareas";

// Preparación, '->' con espacios antes y después opcional
$preparacion = $conn->prepare($select);

//Ejecución, '->' con espacios antes y después opcional
$preparacion->execute();

//Obtener los valores seleccionados
$arrayFilas = $preparacion->fetchAll();

// print_r($arrayFilas);
// Declaramos un color de letra base
$color = "white";

// if ($_GET) {
//     // echo $_GET['id'];
//     // echo $_GET['color'];
//     foreach ($arrayColors as $esp => $eng)
//         if ( $_GET['color'] == $eng )  {
//             $_GET['color'] = $esp;
//             break;
//         }
// }

// Cerramos la conexión
$conn = null;

// echo "<br>"."-----------------"."<br>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Nuestra gestion de tareas</h1>
    </header>
    <main>
        <section>
            <h2>Nuestras tareas</h2>
            <?php foreach ($arrayFilas as $fila) : ?>

                <?php if ( $fila['color'] == "white" || $fila['color'] == "yellow" || $fila['color'] == "pink" || $fila['color'] == "grey" )  {
                    $color = "black";
                 } else {
                    $color = "white";
                 }
                  ?>
                <div class="items" style="background-color:<?= $fila['color'] ?>; color: <?= $color?>">
                    <p>
                        <?= $fila['usuario'] ?>
                    </p>
                    <span>
                        <a href="index.php?id=<?= $fila['id_color']?>&user= <?= str_replace(" ", "%20", $fila['usuario'])?>&color=<?= $fila['color']?>"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="delete.php?id=<?= $fila['id_color']?>"><i class="fa-solid fa-trash"></i></a>
                    </span>
                    
                </div>
                
            <?php endforeach ?>
        </section>
        <section>

            <?php if ($_GET ) : ?>
                <h2>Modifica tus tareas</h2>     
                <form action="update.php" method="post">
                    <fieldset>
                    <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden >
                        <div>
                            <label for="usuario">Tu nombre : </label>
                            <input type="text" name="usuario" id="usuario" value="<?= $_GET['user'] ?>" >
                        </div>
                            <div>
                                <label for="color">Tu color : </label>
                                <input type="text" name="color" id="color" value="<?= $_GET['color']?>" >
                            </div>
                            <div>
                                <button type="submit">Enviar datos</button>
                                <button type="reset">Limpiar formulario</button>
                            </div>

                        </fieldset>

                    </form>
                    <?php else : ?>

            

                 <h2>Crea una nueva tarea</h2>
                 <form action="insert.php" method="post">
                    <fieldset>

                        <div>
                            <label for="usuario">Tu nombre : </label>
                            <input type="text" name="usuario" id="usuario">
                        </div>
                        <div>
                            <label for="color">Tu color : </label>
                            <input type="text" name="color" id="color">
                        </div>
                        <div>
                            <button type="submit">Enviar datos</button>
                            <button type="reset">Limpiar formulario</button>
                        </div>

                    </fieldset>

                 </form>
                 <?php endif;  ?>
        </section>
    </main>
</body>
</html>