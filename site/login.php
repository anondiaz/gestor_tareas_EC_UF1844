<?php

session_start();
require_once 'pdo_bind_connection.php';

// Verificar lo que llega a insert_user.php, si esta establecido y no está ¿vacio?
// Verificar lo que llega a login.php
$verificarUsuario = isset($_POST['usuario']) && $_POST['usuario'];
$verificarpassword = isset($_POST['password']) && $_POST['password'];

// Verificamos que no esten vacios los datos
if (!$verificarUsuario || !$verificarpassword ) {
    $_SESSION['error_cuenta'] = true;
    header('Location: alta_usuarios.php');
    exit();
} 
// Quitar espacios en blanco con trim para limpiar el string
// Quitar espacios en blanco
$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);

// Verificar que no se envien datos vacíos
// Verificar que no se envien datos vacíos
if (empty($usuario) || empty($password) ) {
    $_SESSION['error_cuenta'] = true;
    header('Location: alta_usuarios.php');
    exit();
}

// Parseamos con el entities para evitar inyección de código
$usuario = htmlentities($usuario, ENT_QUOTES, 'UTF-8');
$password = htmlentities($password, ENT_QUOTES, 'UTF-8');

// Verificar si el usuario existe
$stmt = $conn->prepare("SELECT * FROM usuarios_datos WHERE nombre_usuario = :usuario"); 
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();
$usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no existe salimos a index.php otra vez
if (!$usuarioExistente) {
    $_SESSION['user_inexistente'] = true;
    header('Location: index.php');
    exit();
}

// Verificamos la contraseña, si no es valida salimos a index.php otra vez
if (!password_verify($password, $usuarioExistente['password'])) {
    $_SESSION['user_inexistente'] = true;
    header('Location: index.php');
    exit();
}

// Si es ok, mostramos un mensaje
echo "Todo OK";



// O redirigimos a otra página
$_SESSION['usuario'] = $usuarioExistente['$usuario'];
$_SESSION['id_usuario'] = $usuarioExistente['id_usuario'];
header('Location: ../gestor_tareas_EC_UF1844/index.php');
