<?php
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
?>
<header>
    <div class="logo">
        <h1>TaskFlow</h1>
        <?= $verificarUsuario == '' ? '<img src="img/logo-largo.avif" alt="Logo TaskFlow">' : '<img src="../gestor_tareas_site/img/logo-largo.avif" alt="Logo TaskFlow">' ?>
    </div>
    <nav>
        <?php if (!$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']) : ?>
            <ul class="menu">
                <li><a href="index.php#features">Características</a></li>
                <li><a href="index.php#contact">Contacto</a></li>
                <li><a href="alta_usuarios.php">Create una Cuenta</a></li>
                <li><a href="entrada_usuarios.php">Login</a></li>
            </ul>
        <?php else : ?>
            <ul class="login-gestion">
                <li><a href="../gestor_tareas_site/logout.php">Logout</a></li>
                <li><a href="gestion-usuario.php">Gestión de cuenta</a></li>
            </ul>
        <?php endif; ?>
    </nav>
</header>