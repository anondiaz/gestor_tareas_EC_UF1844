<?php
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
?>
<?= $verificarUsuario == '' ? '<link rel="stylesheet" href="css/style.css">' : '<link rel="stylesheet" href="../css/style.css">' ?> 
<?= $verificarUsuario == '' ? '' : '<link rel="stylesheet" href="css/tareas.css">' ?> 
<?= $verificarUsuario == '' ? '<link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">' : '<link rel="shortcut icon" href="../gestor_tareas_site/img/logo.ico" type="image/x-icon">' ?> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
