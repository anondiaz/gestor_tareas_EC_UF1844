<?php

// Llamamos a la sesion
session_start();
// $_SESSION['session-token'] = bin2hex(random_bytes(32)); // Seguridad crearmos un numero aleatorio dificil de descifrar
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
// echo $verificarUsuario;
// echo "<br>"."----------"."<br>";
if (!$verificarUsuario) {
    // Cono hay sesion que cerrar, simplemente redireccionaremos a la pagina de inicio
    $_SESSION['error_cuenta'] = true;
    // echo "no esta logueado";
    // echo "<br>"."----------"."<br>";
    // print_r($_SESSION);
    // echo "<br>"."----------"."<br>";
    header('Location: index.php');
    exit();
} else {
    // Aquí cerraremos la sesion de usuario y redireccionaremos a la pagina de inicio
    // echo "esta logueado";
    // echo "<br>"."----------"."<br>";
    // print_r($_SESSION);
    // echo "<br>"."----------"."<br>";
    // Borramos la sesion
    session_unset();
    // print_r($_SESSION);
    // echo "<br>"."----------"."<br>";
    // Destruimops la sesion
    session_destroy();
    // print_r($_SESSION);
    // echo "<br>"."----------"."<br>";
    // echo "Sesión finalizada";
    // Reenviamos a otra página
    header('location:index.php');
    exit();
}