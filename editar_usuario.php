<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'include/conect.php';

// Obtener el ID del usuario a editar
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if ($id_usuario == 0) {
    header('Location: control_usuarios.php');
    exit;
}

// Consulta para obtener los datos del usuario
$query_usuario = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_usuario = $conexion->query($query_usuario);

if ($resultado_usuario->num_rows == 0) {
    header('Location: control_usuarios.php');
    exit;
}

$usuario = $resultado_usuario->fetch_assoc();

// Consulta para obtener todos los pokemones (para el select de compañero)
$query_pokemon = "SELECT id_poke, npoke FROM pokemon ORDER BY npoke ASC";
$resultado_pokemon = $conexion->query($query_pokemon);
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

        .form-label {
            font-weight: bold;
        }
    </style>
    <title>Editar Usuario</title>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container">
        <h1 class="text-center mt-4">Editar Usuario</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="include/actualizar_usuario.php" method="POST">
                        <input type="hidden" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoP" name="apellidoP" 
                                       value="<?php echo htmlspecialchars($usuario['ApellidoP']); ?>" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidoM" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoM" name="apellidoM" 
                                       value="<?php echo htmlspecialchars($usuario['ApellidoM']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Dejar en blanco para no cambiar">
                                <small class="text-muted">Solo ingresa una contraseña si deseas cambiarla</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="admin" <?php echo ($usuario['rol'] == 'admin') ? 'selected' : ''; ?>>
                                        Administrador
                                    </option>
                                    <option value="editor" <?php echo ($usuario['rol'] == 'editor') ? 'selected' : ''; ?>>
                                        Editor
                                    </option>
                                    <option value="visitante" <?php echo ($usuario['rol'] == 'visitante') ? 'selected' : ''; ?>>
                                        Visitante
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="id_poke_companero" class="form-label">Pokémon Compañero</label>
                                <select class="form-select" id="id_poke_companero" name="id_poke_companero">
                                    <option value="">Sin compañero</option>
                                    <?php while ($pokemon = $resultado_pokemon->fetch_assoc()): ?>
                                        <option value="<?php echo $pokemon['id_poke']; ?>" 
                                                <?php echo ($usuario['id_poke_companero'] == $pokemon['id_poke']) ? 'selected' : ''; ?>>
                                            <?php echo $pokemon['npoke']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="control_usuarios.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
