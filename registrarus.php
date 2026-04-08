<?php
session_start();
require 'include/conect.php';

$error = "";

if (isset($_POST['BtnLogin'])) {
    $nombre = $conexion->real_escape_string($_POST['Nombre']);
    $ApellidoP = $conexion->real_escape_string($_POST['ApellidoP']);
    $ApellidoM = $conexion->real_escape_string($_POST['ApellidoM']);
    $email = $conexion->real_escape_string($_POST['email']);
    $password = $conexion->real_escape_string($_POST['password']);

    $rol = 'visitante';

    // INSERTAR USUARIO
    $insert = "INSERT INTO usuarios (nombre, ApellidoP, ApellidoM, email, password, rol) 
    VALUES ('$nombre', '$ApellidoP', '$ApellidoM', '$email', '$password', '$rol')";

    if ($conexion->query($insert)) {

        // OBTENER ID DEL USUARIO REGISTRADO
        $id_usuario = $conexion->insert_id;

        // CREAR SESIÓN AUTOMÁTICA
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['ApellidoP'] = $ApellidoP;
        $_SESSION['ApellidoM'] = $ApellidoM;
        $_SESSION['rol'] = $rol;

        // REDIRIGIR
        header("Location: perfil.php?id_usuario=" . $id_usuario);
        exit;

    } else {
        $error = "Error al registrar usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registarse POKEDEX</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)),
                url('assets/img/made-this-pokeball-wallpaper-for-fun-2560-x-1440-will-take-v0-f2Dek-N2L1qqxugRbpozk_SapDPku3Aa8FLHu9c_VBA.webp') no-repeat center center/cover;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
        <div class="card p-4" style="width: 380px;">
            <div class="text-center mb-3">
                <h3 class="fw-bold">Registrar usuario </h3>
                <p class="text-muted">Crea tu cuenta Pokédex</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="post">
<div class="row mt-2">
     <label class="form-label">Nombre</label>
      <input type="text" name="Nombre" id="nombre" class="form-control">
      </div>  
      <div class="row mt-2">
        <div class="col">
             <label class="form-label">Apellido Paterno</label>
            <input type="text" name="ApellidoP" id="ApellidoP"  class="form-control">
        </div>
        <div class="col">
             <label class="form-label">Apellido Materno</label>
            <input type="text" name="ApellidoM" id="ApellidoM"  class="form-control">
        </div>
      </div> 
    
                <div class="mb-3">
                    <label class="form-label">Crea un electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="trainer@pokedex.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" name="BtnLogin" class="btn btn-danger w-100 fw-bold">
                    Registrarse
                </button>
            </form>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>