<?php

session_start();
require_once 'pdo_bind_connection.php';

// Verificar lo que llega a insert_user.php, si esta establecido y que la variable exista
$verificarUsuario = isset($_POST['usuario']) && $_POST['usuario'];
$verificarpassword = isset($_POST['password']) && $_POST['password'];
$verificarpassword2 = isset($_POST['password2']) && $_POST['password2'];
$verificarNombre = isset($_POST['nombre']) && $_POST['nombre'];
$verificarApellidos = isset($_POST['apellidos']) && $_POST['apellidos'];

// Verificamos que no esten vacios los datos
if (!$verificarUsuario || !$verificarpassword || !$verificarpassword2) {
    $_SESSION['error_cuenta'] = true;
    header('Location: alta_usuarios.php');
    exit();
} 
// Quitar espacios en blanco con trim para limpiar el string
$usuario = trim($_POST['usuario']);
$password = trim($_POST['password']);
$password2 = trim($_POST['password2']);
$nombre = trim($_POST['nombre']);
$apellidos = trim($_POST['apellidos']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);

// Verificar que no se envien datos vacíos
if (empty($usuario) || empty($password) || empty($password2)) {
    $_SESSION['error_cuenta'] = true;
    header('Location: alta_usuarios.php');
    exit();
}

// Parseamos con el entities para evitar inyección de código
$usuario = htmlentities($usuario, ENT_QUOTES, 'UTF-8');
$password = htmlentities($password, ENT_QUOTES, 'UTF-8');
$password2 = htmlentities($password2, ENT_QUOTES, 'UTF-8');
$nombre = htmlentities($nombre, ENT_QUOTES, 'UTF-8');
$apellidos = htmlentities($apellidos, ENT_QUOTES, 'UTF-8');
$email = htmlentities($email, ENT_QUOTES, 'UTF-8');
$telefono = htmlentities($telefono, ENT_QUOTES, 'UTF-8');

// Validamos que las contraseñas coincidan
if ($password !== $password2) {
    $_SESSION['error_cuenta'] = true;
    header('Location: alta_usuarios.php');
    exit();
}

// Verificar si el usuario existe o no, para que no se puedan crear 2 usuarios iguales
// Para ello primero lanzamos una querie
$stmt = $conn->prepare("SELECT * FROM usuarios_datos WHERE nombre_usuario = :usuario"); 
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();
$usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

// Y después validamos con un if
if ($usuarioExistente) {
    $_SESSION['user_repe'] = true;
    header('Location: alta_usuarios.php');
    exit();
} 

// Ciframos la contraseña con bcrypt
$hash = password_hash($password, PASSWORD_DEFAULT);

// Finalmente realizamos el insert del usuario, esta es otra forma
$insert = "INSERT INTO usuarios_datos (nombre_usuario, password) VALUES (:usuario, :password)";
$stmt = $conn->prepare($insert);
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':password', $hash, PDO::PARAM_STR);
$stmt->execute();

// $id_usuario = 0;
// Verificar si el usuario existe
$stmt = $conn->prepare("SELECT * FROM usuarios_datos WHERE nombre_usuario = :usuario"); 
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->execute();
$usuarioCreado = $stmt->fetch(PDO::FETCH_ASSOC);
$id_usuario = $usuarioCreado['id_usuario'];

// Finalmente realizamos el insert del usuario, esta es otra forma
$insert = "INSERT INTO usuarios_detalle (nombre_persona, apellidos_persona, email, telefono, id_usuario) VALUES (:nombre, :apellidos, :email, :telefono, :id_usuario)";
$stmt = $conn->prepare($insert);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
$stmt->execute();

// Mostramos mensaje de inserción correcta
// echo "Usuario insertado correctamente<br>";

// Reenviamos a la pagina index para mostrar el login
header('Location: entrada_usuarios.php');