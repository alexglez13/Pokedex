<?php
session_start();
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'editor')) {
    header('Location: index.php');
    exit;
}

include 'include/conect.php';
include 'include/querys.php';

// Guardar el mensaje en variable, no hacer echo todavía
$Mensaje = "";
if (isset($_GET['actualizacion']) && $_GET['actualizacion'] == "exitosa") {
    $Mensaje = "actualizacion";
}
if (isset($_GET['eliminacion']) && $_GET['eliminacion'] == "exitosa") {
    $Mensaje = "eliminacion";
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
    </style>
    <title>Control de pokemones</title>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container">
        <h1 class="text-center mt-4">Consulta pokemon</h1>

        <!-- Mensaje AQUÍ, después del navbar y dentro del container -->
        <?php if ($Mensaje == "actualizacion"): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <strong>Actualización exitosa.</strong> Se actualizaron los campos correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($Mensaje == "eliminacion"): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Eliminado.</strong> El Pokémon fue eliminado correctamente.
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre pokemon</th>
                        <th>Tipo poke</th>
                        <th>Sexo</th>
                        <th>Descripción</th>
                        <th>Región</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Legendario</th>
                        <th>Opcion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($editaree->num_rows == 0): ?>
                        <tr>
                            <td colspan="9">No hay datos</td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($row = $editaree->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['npoke'] ?></td>
                            <td><?php echo $row['id_tpoke'] ?></td>
                            <td><?php echo $row['id_sexo'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['id_region'] ?></td>
                            <td><?php echo $row['peso'] ?></td>
                            <td><?php echo $row['altura'] ?></td>
                            <td><?php echo $row['legendario'] ?></td>
                            <td>
                                <a href="editar.php?id_poke=<?php echo $row['id_poke']; ?>" class="btn btn-warning btn-sm"
                                    style="width: 65px; font-size: 0.875rem;">Editar</a>
                                <a href="include/Eliminar.php?id=<?php echo $row['id_poke']; ?>"
                                    class="btn btn-danger btn-sm" style="width: 65px; font-size: 0.875rem;">
                                    Eliminar
                                </a>
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