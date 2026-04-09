<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'include/conect.php';

// Consulta para obtener todos los usuarios
$query_usuarios = "SELECT u.*, p.npoke as pokemon_companero 
                   FROM usuarios u 
                   LEFT JOIN pokemon p ON u.id_poke_companero = p.id_poke 
                   ORDER BY u.id_usuario ASC";
$resultado_usuarios = $conexion->query($query_usuarios);

// Guardar el mensaje en variable
$Mensaje = "";
if (isset($_GET['actualizacion']) && $_GET['actualizacion'] == "exitosa") {
    $Mensaje = "actualizacion";
}
if (isset($_GET['eliminacion']) && $_GET['eliminacion'] == "exitosa") {
    $Mensaje = "eliminacion";
}
if (isset($_GET['creacion']) && $_GET['creacion'] == "exitosa") {
    $Mensaje = "creacion";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff9db;
        }

        .card {
            background-color: #fff3b0;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #f7dc6f;
        }

        .badge-admin {
            background-color: #359fdc;
        }

        .badge-editor {
            background-color: #ffde07;
            color: black
        }

        .badge-visitante {
            background-color: #6c757d;
        }
    </style>
    <title>Control de Usuarios</title>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container">
        <h1 class="text-center mt-4">Control de Usuarios</h1>

        <!-- Mensajes de notificación -->
        <?php if ($Mensaje == "actualizacion"): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Actualización exitosa.</strong> Se actualizaron los datos del usuario correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($Mensaje == "eliminacion"): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Eliminado.</strong> El usuario fue eliminado correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($Mensaje == "creacion"): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Usuario creado.</strong> El nuevo usuario fue registrado exitosamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Limpiar el parámetro de la URL sin recargar -->
        <?php if ($Mensaje): ?>
            <script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.pathname);
                }
            </script>
        <?php endif; ?>

        <div class="row mt-3">
            <div class="col-12 mb-3">
                <a href="crear_usuario.php" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Nuevo Usuario
                </a>
            </div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Compañero</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado_usuarios->num_rows == 0): ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay usuarios registrados</td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($usuario = $resultado_usuarios->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $usuario['id_usuario']; ?></td>
                            <td>
                                <?php echo $usuario['nombre'] . ' ' . $usuario['ApellidoP'] . ' ' . $usuario['ApellidoM']; ?>
                            </td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td>
                                <?php
                                $badge_class = "";
                                switch ($usuario['rol']) {
                                    case 'admin':
                                        $badge_class = "badge-admin";
                                        break;
                                    case 'editor':
                                        $badge_class = "badge-editor";
                                        break;
                                    case 'visitante':
                                        $badge_class = "badge-visitante";
                                        break;
                                }
                                ?>
                                <span class="badge <?php echo $badge_class; ?>">
                                    <?php echo ucfirst($usuario['rol']); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo $usuario['pokemon_companero'] ? $usuario['pokemon_companero'] : 'Sin compañero'; ?>
                            </td>
                            <td>
                                <a href="editar_usuario.php?id_usuario=<?php echo $usuario['id_usuario']; ?>" 
                                   class="btn btn-warning btn-sm" style="width: 65px; font-size: 0.875rem;">
                                    Editar
                                </a>
                                <?php if ($usuario['id_usuario'] != $_SESSION['id_usuario']): ?>
                                    <a href="include/eliminar_usuario.php?id=<?php echo $usuario['id_usuario']; ?>"
                                       class="btn btn-danger btn-sm" 
                                       style="width: 65px; font-size: 0.875rem;"
                                       onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        Eliminar
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-secondary btn-sm" 
                                            style="width: 65px; font-size: 0.875rem;" 
                                            disabled>
                                        Eliminar
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
