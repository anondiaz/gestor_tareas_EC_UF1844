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

    <main>
        <section id="features">
            <h2>Características de TaskFlow</h2>
            <div class="features">
                <div class="feature">
                    <img src="img/tablero.avif" alt="Tableros intuitivos">
                    <div class="content">
                        <h3>Toma el control de tus tareas</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                    </div>
                </div>
                <div class="feature">
                    <img src="img/tablero.avif" alt="Colaboración en tiempo real">
                    <div class="content">
                        <h3>Prioriza lo urgente</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                    </div>
                </div>
                <div class="feature">
                    <img src="img/movil.avif" alt="Notificaciones automáticas">
                    <div class="content">
                        <h3>Utilizalo alla donde estes</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include_once 'modulos/footer.php' ?>
</body>
</html>
