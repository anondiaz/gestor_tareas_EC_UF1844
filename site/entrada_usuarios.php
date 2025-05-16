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
    <!-- Las etiquetas meta y enlaces a ficheros las llamamos con php -->
    <?php include_once 'modulos/meta.php' ?>
    <title>TaskFlow - Gestión de Tareas</title>
    <?php include_once 'modulos/link_files.php' ?>
</head>
<body>
<?php include_once 'modulos/header.php' ?>
    <main class="index-main">

        <!-- Llamamos al login.php con el formulario-->
                <form action="login.php" method="post">
            <fieldset>
                <h1>Iniciar sesión</h1>
                <div>
                    <label for="usuario">Nombre:</label>
                    <input type="text" name="usuario" id="usuario">
                </div>
                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <a href="alta_usuarios.php">Crear una cuenta</a>
                </div>
                 
                <div class="error_cuenta">
                    <!-- En caso de error en los datos mostramos mensaje con un condicional if -->
                    <?php if ($_SESSION['error_cuenta']): ?>
                        <p>Error en los datos</p>
                    <?php endif; ?>
                </div>
                <div class="error_cuenta">
                    <!-- En caso de error en los datos mostramos mensaje con un condicional if -->
                    <?php if ($_SESSION['user_inexistente']): ?>
                        <p>Usuario o contraseña incorrectos</p>
                    <?php endif; ?>
                </div>
                <div class="botones">
                    <button type="submit">Enviar</button>
                    <button type="reset">Borrar</button>
                </div>
                <!-- Ponemos un enlace para volver al inicio -->
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
$_SESSION['user_inexistente'] = false;