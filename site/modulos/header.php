<?php
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
?>
<header>
    <div>
        <div class="logo">
            <h1>TaskFlow</h1>
            <?= $verificarUsuario == '' ? '<img src="img/logo-largo.avif" alt="Logo TaskFlow">' : '<img src="../gestor_tareas_site/img/logo-largo.avif" alt="Logo TaskFlow">' ?>
        </div>
        <div class="login-gestion">
                <?= $verificarUsuario == '' ? '<a href="entrada_usuarios.php">Login</a>' : '<a href="../gestor_tareas_site/logout.php">Logout</a>' ?>    
                <?= $verificarUsuario == '' ? '' : '<a href="gestion-usuario.php">Gestión de cuenta</a>' ?> 
        </div>
    </div>
    <?php if(!$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']) : ?>
    <nav>
        <ul>
            <li><a href="index.php#features">Características</a></li>
            <li><a href="alta_usuarios.php">Create una Cuenta</a></li>
            <li><a href="index.php#contact">Contacto</a></li>
        </ul>
    </nav>
    <?php endif; ?>
</header>