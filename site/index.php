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
    <?php include_once 'etiquetas_meta.php'; ?>
    <title>Colores</title>
</head>
<body>
    <header><h1>Acceso usuarios</h1><p>Hola <?= $_SESSION['usuario'] ?></p>
        <!-- Creamos un menú -->
        <nav class="index-nav">
            <ul>            
                <!-- Tenemos dos enlaces en el menú para llamar a las correspondientes páginas -->
                <li><a href="crear_cuenta.php">Crear cuenta</a></li>
                <li><a href="index.php">Iniciar sesión</a></li>


            </ul>
        </nav>
    </header>
    <main class="index-main">
        <!-- Mostraremos un dialog para el login -->
    <dialog id="login" open closedby="any">
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
                    <a href="crear_cuenta.php">Crear una cuenta</a>
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
                <!-- <a href="index.php">Volver</a> -->

            </fieldset>
        </form>
    </dialog>
    </main>


</body>
</html>
<?php
// Reseteamos las variables a false para que en la siguiente carga no se muestre el mensaje
$_SESSION['error_cuenta'] = false;
$_SESSION['user_inexistente'] = false;