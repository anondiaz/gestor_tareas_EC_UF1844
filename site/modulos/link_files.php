<?php
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
?>
<?= $verificarUsuario == '' ? '<link rel="stylesheet" href="css/style.css">' : '<link rel="stylesheet" href="../gestor_tareas_site/css/style.css">' ?> 
<link rel="stylesheet" href="css/tareas.css">
<?= $verificarUsuario == '' ? '<link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">' : '<link rel="shortcut icon" href="../gestor_tareas_site/img/logo.ico" type="image/x-icon">' ?> 

