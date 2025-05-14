<?php

require_once 'connection.php';
// require_once 'traduccion_estados.php';
// echo "Soy el index.php";
// echo "<br>"."-----------------"."<br>";

// Definir la querie como string
$select = "SELECT id_tarea, id_estado, id_usuario, ta.titulo, ta.descripcion, ta.fecha_prevista_fin, es.nombre_estado, usd.nombre_usuario 
FROM tareas ta
NATURAL JOIN estados es
NATURAL JOIN usuarios_datos usd
WHERE ta.borrada = 0";

// Preparación, '->' con espacios antes y después opcional
$preparacion = $conn->prepare($select);

//Ejecución, '->' con espacios antes y después opcional
$preparacion->execute();

//Obtener los valores seleccionados
$arrayFilas = $preparacion->fetchAll();

// print_r($arrayFilas);

// foreach ($arrayFilas as $fila) {
//     print_r($fila);
//     echo "<br>"."-----------------"."<br>";
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
        <h1>Tasked</h1>
    </header>
    <main>
        <section class="formularios">
            <?php if ($_GET) : ?>
                <h2>Modifica tus tareas</h2>

                <form action="update.php" method="post">
                    <div class="crear">
                        <input type="text" name="id" value="<?= $_GET['id'] ?>" hidden>
                        <div class="datos">
                            <div class="base">
                                <label for="usuario">Título : </label>
                                <input maxlength="40" type="text" name="titulo" id="titulo" value="<?= $_GET['titulo'] ?>">
                                <div>
                                    <legend>Elige un estado</legend>
                                    <!-- Comprobamos cual es el estado del select -->
                                    <?php $estado = isset($_GET['nombre_estado']) ? $_GET['nombre_estado'] : 'Pendiente'; ?>
                                    <!-- <?= $estado ?>                             -->
                                    <select name="estado" id="estado">
                                        <!-- Añadimos el selected para mostrarlo en el formulario
                                 Si $estado es exactamente igual al nombre del estado entences escribimos selected
                                 Si no lo dejamos vacio, y siempre será alguno de estos
                                  -->
                                        <option value="Pendiente" <?= $estado === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                        <option value="Ejecución" <?= $estado === 'Ejecución' ? 'selected' : '' ?>>Ejecución</option>
                                        <option value="Finalizada" <?= $estado === 'Finalizada' ? 'selected' : '' ?>>Finalizada</option>
                                        <option value="Urgente" <?= $estado === 'Urgente' ? 'selected' : '' ?>>Urgente</option>
                                    </select>
                                    <!-- Original -->
                                    <!-- <select name="estado" id="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="Ejecución">Ejecución</option>
                                <option value="Finalizada">Finalizada</option>
                                <option value="Urgente">Urgente</option>
                            </select> -->
                                </div>
                                <p> * Aquí puedes seleccionar un nuevo estado, el seleccionado es el actual.</p>
                            </div>
                            <!-- <?= $_GET['descripcion'] ?> -->
                            <?php $descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : ''; ?>
                            <div class="detalle">
                                <label for="color">Descripción : </label>
                                <textarea name="descripcion" maxlength="150"><?= htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8') ?></textarea>
                            </div>
                            <!-- <?= $_GET['fechafin'] ?>
                            <br>
                            <?= $_GET['horafin'] ?> -->
                            <?php
                            $fechafin = isset($_GET['fechafin']) ? $_GET['fechafin'] : '';
                            $horafin = isset($_GET['horafin']) ? $_GET['horafin'] : '';
                            ?>
                            <div class="fecha">
                                <label for="entrada">Fecha de finalización :</label>
                                <input type="date" name="fechafin" id="fechafin" value="<?= htmlspecialchars($fechafin, ENT_QUOTES, 'UTF-8') ?>"/>
                                <input type="time" name="horafin" id="horafin" value="<?= htmlspecialchars($horafin, ENT_QUOTES, 'UTF-8') ?>" />
                            </div>
                        </div>
                        <div class="botones">
                            <button type="submit">Guardar Tarea</button>
                            <button type="button" onclick="location.href='<?= 'index.php'; ?>'">Cancelar</button>
                        </div>
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
                                <p> * Marcando esta casilla se marcará como urgente.</p>
                            </div>
                            <div class="detalle">
                                <label for="color">Descripción : </label>
                                <textarea name="descripcion" maxlength="150"></textarea>
                            </div>
                            <div class="fecha">
                                <label for="entrada">Fecha de finalización :</label>
                                <input type="date" name="fechafin" id="fechafin" required />
                                <input type="time" name="horafin" id="horafin" />
                                <p>* Con Fecha</p>
                                <p>por defecto: 23:59</p>
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
            <!-- <h2>Nuestras tareas</h2> -->
            <div class="tareas">
                <div class="estados urgente">
                    <h3>Tareas urgentes</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <!-- <?= $fila['nombre_estado'] ?> -->
                        <?php if ($fila['nombre_estado'] == "Urgente") : ?>

                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['nombre_estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['nombre_estado']) ?>&fechafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>&horafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="pre-delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                               
                                <p class="<?= $fila['fecha_prevista_fin'] == '' ? 'sinffinal' : 'ffinal' ?>"><?= $fila['fecha_prevista_fin'] == '' ? 'Sin fecha de finalización' : 'Fecha prevista de finalización' ?>:</p>
                                <p>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : 'a las:' ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>
                                </p>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados pendiente">
                    <h3>Tareas pendientes</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['nombre_estado'] == "Pendiente") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['nombre_estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['nombre_estado']) ?>&fechafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>&horafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                                
                                <p class="<?= $fila['fecha_prevista_fin'] == '' ? 'sinffinal' : 'ffinal' ?>"><?= $fila['fecha_prevista_fin'] == '' ? 'Sin fecha de finalización' : 'Fecha prevista de finalización' ?>:</p>
                                <p>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : 'a las:' ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>
                                </p>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados ejecucion">
                    <h3>Tareas en ejecución</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['nombre_estado'] == "Ejecución") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['nombre_estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['nombre_estado']) ?>&fechafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>&horafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                                <p class="<?= $fila['fecha_prevista_fin'] == '' ? 'sinffinal' : 'ffinal' ?>"><?= $fila['fecha_prevista_fin'] == '' ? 'Sin fecha de finalización' : 'Fecha prevista de finalización' ?>:</p>
                                <p>
                                <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : 'a las:' ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>
                                </p>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
                <div class="estados finalizada">
                    <h3>Tareas finalizadas</h3>
                    <?php foreach ($arrayFilas as $fila) : ?>
                        <?php if ($fila['nombre_estado'] == "Finalizada") : ?>
                            <div class="items">
                                <h4>
                                    <?= $fila['titulo'] ?>
                                </h4>
                                <p>
                                    <?= $fila['descripcion'] ?>
                                </p>
                                <div>
                                    <p>
                                        <?= $fila['nombre_estado'] ?>
                                    </p>
                                    <span>
                                        <a href="index.php?id=<?= $fila['id_tarea'] ?>&titulo= <?= str_replace(" ", "%20", $fila['titulo']) ?>&descripcion=<?= str_replace(" ", "%20", $fila['descripcion']) ?>&estado=<?= str_replace(" ", "%20", $fila['nombre_estado']) ?>&fechafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>&horafin=<?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>"><i class="fa-solid fa-user-pen"></i></a>
                                        <a href="delete.php?id=<?= $fila['id_tarea'] ?>"><i class="fa-solid fa-trash"></i></a>
                                    </span>
                                </div>
                                <p class="<?= $fila['fecha_prevista_fin'] == '' ? 'sinffinal' : 'ffinal' ?>"><?= $fila['fecha_prevista_fin'] == '' ? 'Sin fecha de finalización' : 'Fecha prevista de finalización' ?>:</p>
                                <p>
                                <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[0] ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : 'a las:' ?>
                                    <?= $fila['fecha_prevista_fin'] == '' ? '' : explode(" ", $fila['fecha_prevista_fin'])[1] ?>
                                </p>
                            </div>
                        <?php endif;  ?>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    </main>
</body>

</html>