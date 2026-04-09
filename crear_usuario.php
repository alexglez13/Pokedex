<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'include/conect.php';

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
    <title>Crear Usuario</title>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container">
        <h1 class="text-center mt-4">Crear Nuevo Usuario</h1>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card p-4">
                    <form action="include/registrar_usuario.php" method="POST">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="apellidoP" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoP" name="apellidoP" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidoM" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoM" name="apellidoM" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label">Rol</label>
                                <select class="form-select" id="rol" name="rol" required>
                                    <option value="visitante" selected>Visitante</option>
                                    <option value="editor">Editor</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="id_poke_companero" class="form-label">Pokémon Compañero</label>
                                <select class="form-select" id="id_poke_companero" name="id_poke_companero">
                                    <option value="" selected>Sin compañero</option>
                                    <?php while ($pokemon = $resultado_pokemon->fetch_assoc()): ?>
                                        <option value="<?php echo $pokemon['id_poke']; ?>">
                                            <?php echo $pokemon['npoke']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="control_usuarios.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        // Validar que las contraseñas coincidan
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
            }
        });
    </script>
</body>

</html>
