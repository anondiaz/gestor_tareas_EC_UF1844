<?php
$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'];
?>
<header>
    <div class="logo">
        <?= $verificarUsuario == '' ? '<img src="img/logo-largo.avif" alt="Logo TaskFlow">' : '<img src="../img/logo-largo.avif" alt="Logo TaskFlow">' ?>
        <h1><a href="http://www.bewsystems.com">by Bewsystems</a></h1>
    </div>
    <nav class="navbar">
        <button class="hamburger" id="hamburger-btn" aria-label="Abrir menú">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </button>
        <?php if (!$verificarUsuario = isset($_SESSION['id_usuario']) && $_SESSION['id_usuario']) : ?>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="index.php#features">Características</a></li>
                <li><a href="index.php#contact">Contacto</a></li>
                <li><a href="alta_usuarios.php">Create una Cuenta</a></li>
                <li><a href="entrada_usuarios.php">Login</a></li>
            </ul>
        <?php else : ?>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="../logout.php">Logout</a></li>
                <li><a href="../gestion-usuario.php">Gestión de cuenta</a></li>
            </ul>
        <?php endif ; ?>
    </nav>
</header>
