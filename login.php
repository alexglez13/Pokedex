<<<<<<< HEAD
php
=======
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
<?php
session_start();
require 'include/conect.php';

$error = "";

if (isset($_POST['BtnLogin'])) {
    $email = $conexion->real_escape_string($_POST['email']);
    $password = ($_POST['password']);

    $query = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = $conexion->query($query);

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
<<<<<<< HEAD
        // Guardar datos en sesión
=======
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        header('Location: index.php');
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<<<<<<< HEAD

=======
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
<head>
    <meta charset="UTF-8">
    <title>Login - POKEDEX</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
                url('assets/img/made-this-pokeball-wallpaper-for-fun-2560-x-1440-will-take-v0-f2Dek-N2L1qqxugRbpozk_SapDPku3Aa8FLHu9c_VBA.webp') no-repeat center center/cover;
<<<<<<< HEAD
            height: 100vh;
=======
            min-height: 100vh;
            margin: 0;
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<<<<<<< HEAD
<body class="d-flex justify-content-center align-items-center">
    <div class="card p-4" style="width: 380px;">
        <div class="text-center mb-3">
            <h3 class="fw-bold">🔐 Iniciar Sesión</h3>
            <p class="text-muted">Accede a tu cuenta Pokédex</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" placeholder="trainer@pokedex.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" name="BtnLogin" class="btn btn-danger w-100 fw-bold">
                Entrar
            </button>
        </form>
=======
<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
        <div class="card p-4" style="width: 380px;">
            <div class="text-center mb-3">
                <h3 class="fw-bold">🔐 Iniciar Sesión</h3>
                <p class="text-muted">Accede a tu cuenta Pokédex</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="trainer@pokedex.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" name="BtnLogin" class="btn btn-danger w-100 fw-bold">
                    Entrar
                </button>
            </form>
        </div>
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
<<<<<<< HEAD

=======
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
</html>