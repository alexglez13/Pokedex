<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">POKEDEX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Inicio siempre visible -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <!-- <li class="nav-item">
                        <a class="nav-link" href="jugar.php">Jugar</a>
                    </li> -->
                    
                <?php if (isset($_SESSION['rol'])): ?>
                    <!-- Solo con sesión -->
                    <li class="nav-item">
                        <a class="nav-link" href="jugar.php">Jugar</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <!-- Solo visible para el admin -->
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="prueba.php">Registrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="control.php">Control Pokemon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="control_usuarios.php">Control Usuarios</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'editor'): ?>
                    <!-- Solo visible para editores -->
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="prueba.php">Registrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="control.php">Control</a>
                    </li>
                <?php endif; ?>


                <?php if (isset($_SESSION['id_usuario'])): ?>

                    <?php if ($_SESSION['rol'] === 'admin'): ?>
        <li class="nav-item ms-2">
            <a class="nav-link" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario'] ?>">
                 Administrador <?php echo htmlspecialchars($_SESSION['nombre']); ?>
            </a>
        </li>
    <?php endif; ?>

    <?php if ($_SESSION['rol'] === 'editor'): ?>
        <li class="nav-item ms-2">
            <a class="nav-link" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario'] ?>">
                 Editor <?php echo htmlspecialchars($_SESSION['nombre']); ?>
            </a>
        </li>
    <?php endif; ?>

    <?php if ($_SESSION['rol'] === 'visitante'): ?>
        <li class="nav-item ms-2">
            <a class="nav-link" href="perfil.php?id_usuario=<?php echo $_SESSION['id_usuario'] ?>">
                 Visitante <?php echo htmlspecialchars($_SESSION['nombre']); ?>
            </a>
        </li>
    <?php endif; ?>

<?php endif; ?>

                <?php if (isset($_SESSION['id_usuario'])): ?>
                    <!-- Sesión activa: mostrar nombre y botón cerrar sesión -->
                    <li class="nav-item">
                        <a class="btn btn-outline-danger btn-sm ms-1" href="logout.php">Salir</a>
                    </li>
                <?php else: ?>

                    <li class="nav-item ms-2">
                        <a class="btn btn-danger btn-sm" href="registrar.php">Registrar</a>
                    </li>
                    <!-- Sin sesión: mostrar botón login -->
                    <li class="nav-item ms-2">
                        <a class="btn btn-danger btn-sm" href="login.php">Iniciar sesión</a>
                    </li>
<<<<<<< HEAD
=======
                    
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>