<?php

echo "Hola soy index";

require_once 'connection.php';
$select = "SELECT * FROM tareas";

// Preparación, '->' con espacios antes y después opcional
$preparacion = $conn->prepare($select);

//Ejecución, '->' con espacios antes y después opcional
$preparacion->execute();

//Obtener los valores seleccionados
$arrayFilas = $preparacion->fetchAll();

// Cerramos la conexión
$conn = null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Gestor de tareas</h1>
    </header>
    <main>
        <section>
            
            <?php if ($_GET ) : ?>
                <h2>Modifica tu tarea</h2>     
                <form action="update.php" method="post">
                    <fieldset>
                    <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden >
                        <div>
                            <label for="usuario">Título : </label>
                            <input type="text" name="usuario" id="usuario" value="<?= $_GET['user'] ?>" >
                        </div>
                            <div>
                                <label for="color">Descripción : </label>
                                <input type="text" name="color" id="color" value="<?= $_GET['color']?>" >
                            </div>
                            <div>
                                <button type="submit">Actualizar</button>
                                <button type="reset">Limpiar formulario</button>
                            </div>

                        </fieldset>

                    </form>
                    <?php else : ?>

            

                <h2>Alta de tareas</h2>
                 <form action="insert.php" method="post">
                    <fieldset>

                        <div>
                            <label for="usuario">Título : </label>
                            <input type="text" name="usuario" id="usuario">
                        </div>
                        <div>
                            <label for="color">Descripción : </label>
                            <input type="text" name="color" id="color">
                        </div>
                        <div>
                            <button type="submit">Crear tarea</button>
                            <button type="reset">Limpiar formulario</button>
                        </div>

                    </fieldset>

                 </form>
                 <?php endif;  ?>
        </section>
        <section>
        <h2>Gestion de tareas</h2>
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
    </main>
    
</body>
</html>