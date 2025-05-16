<?php

// Para evitar que aparezcan los Warnings en el navegador
// error_reporting(0);

// Inicimos una session
session_start();
// Llamamos al fichero de conexión
require_once 'pdo_bind_connection.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Las etiquetas meta y enlaces a ficheros las llamamos con php -->
    <?php include_once 'modulos/meta.php' ?>
    <title>TaskFlow - Gestión de Tareas</title>
    <?php include_once 'modulos/link_files.php' ?>
</head>
<body>
<?php include_once 'modulos/header.php' ?>
    <main class="index-main">

        <!-- Llamamos al login.php con el formulario-->
        <form action="insert_user.php" method="post">
            <fieldset>
                <h1>Crear cuenta</h1>
                <div>
                    <label for="nombre">* Nombre :</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div>
                    <label for="apellidos">* Apellido/s :</label>
                    <input type="text" name="apellidos" id="apellidos" required>
                </div>
                <div>
                    <label for="usuario">* N. Usuario :</label>
                    <input type="text" name="usuario" id="usuario" required>
                </div>
                <div>
                    <label for="password">* Contraseña :</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div>
                    <label for="password2">* Repite la contraseña :</label>
                    <input type="password" name="password2" id="password2" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <label for="telefono">Teléfono :</label>
                    <input type="tel" name="telefono" id="telefono">
                </div>
                <div class="error_cuenta">
                    <?php if ($_SESSION['error_cuenta']): ?>
                        <p>Error en los datos</p>
                    <?php endif; ?>
                </div>
                <div class="error_cuenta">
                    <?php if ($_SESSION['user_repe']): ?>
                        <p>Usuario o contraseña incorrectos</p>
                    <?php endif; ?>
                </div>
                <div class="botones">
                    <button type="submit">Enviar</button>
                    <button type="reset">Borrar</button>
                </div>
                <p>Los campos marcados con * son obligatorios</p>
                <a href="index.php">Volver a inicio</a>

            </fieldset>
        </form>

    </main>

    <?php include_once 'modulos/footer.php' ?>
</body>
<script src="js/script.js"></script>
</html>
<?php
// Reseteamos las variables a false para que en la siguiente carga no se muestre el mensaje
$_SESSION['error_cuenta'] = false;
$_SESSION['user_repe'] = false;