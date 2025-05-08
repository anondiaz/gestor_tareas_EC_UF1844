<?php

// Formas de llamar a un fichero en PHP, "introduce" el codigo en el punto donde se halle
// include 'nombre_fichero.php'; // Usar el error como un warning, no detendremos el script
// require 'nombre_fichero.php'; // Usar el error como crítico y detiene el script
// include_once 'nombre_fichero.php';  // Usar el error como un warning, no detendremos el script, solo realiza la conexión una vez
// require_once 'nombre_fichero.php'; // Usar el error como crítico y detiene el script, solo realiza la conexión una vez

require_once 'connection.php';
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
// $color = "white";

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
    <meta name="author" content="bewsystems by anondiaz" />
    <meta name="description" content="Gestión de tareas" />
    <meta name="keywords" content="Gestión de tareas" />
    <title>Gestor de tareas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Nuestra gestion de tareas</h1>
    </header>
    <main>
        <section class="formularios">
            <?php if ($_GET) : ?>
                <h2>Modifica tus tareas</h2>
                <form class="modificar" action="update.php" method="post">

                    <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
                    <div>
                        <label for="usuario">Título : </label>
                        <input type="text" name="titulo" id="titulo" value="<?= $_GET['titulo'] ?>">
                    </div>
                    <div>
                        <label for="color">Descripción : </label>
                        <input type="text" name="descripcion" id="descripcion" value="<?= $_GET['descripcion'] ?>">
                    </div>
                    <div>
                        <legend>Elige un estado</legend>
                        <select name="estado" id="estado" value="<?= $_GET['estado'] ?>">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Ejecución">Ejecución</option>
                            <option value="Finalizada">Finalizada</option>
                            <option value="Urgente">Urgente</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit">Guardar Tarea</button>
                        <button type="reset">Cancelar</button>
                    </div>

                </form>
            <?php else : ?>
                <h2>Crea una nueva tarea</h2>
                <form action="insert.php" method="post">
                    <div class="crear">
                        <div class="datos">
                            <div class="base">
                                <label for="usuario">Título : </label>
                                <input maxlength="40" type="text" name="titulo" id="titulo">
                                <div>
                                    <input type="checkbox" name="urgente" id="urgente">
                                    <label for="urgente">Urgente</label>
                                </div>
                                <p> * Marcando esta casilla se marcará como urgente</p>
                            </div>
                            <div class="detalle">
                                <label for="color">Descripción : </label>
                                <textarea name="descripcion" maxlength="150"></textarea>
                            </div>
                        </div>
                        <div class="botones">
                            <button type="submit">Crear tarea</button>
                            <button type="reset">Limpiar formulario</button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </section>
        <section>
            <h2>Nuestras tareas</h2>
            <div class="tareas">
                <div class="estados urgente">
                    <h3>Tareas urgentes</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <!-- <?= $fila['estado'] ?> -->
                        <?php if ($fila['estado'] == "Urgente") : ?>

                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['estado']) ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados pendiente">
                    <h3>Tareas pendientes</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['estado'] == "Pendiente") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['estado']) ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados ejecucion">
                    <h3>Tareas en ejecución</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['estado'] == "Ejecución") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['estado']) ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados finalizada">
                    <h3>Tareas finalizadas</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['estado'] == "Finalizada") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['estado']) ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>