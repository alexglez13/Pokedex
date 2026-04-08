<?php
session_start();
include 'include/conect.php';

if (!isset($_SESSION['id_usuario'])) {
    echo "<h3 style='color:white;text-align:center;'>Debes iniciar sesión</h3>";
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// CONSULTAR PARTIDAS
$partidas = [];

$stmt = $conexion->prepare(
    "SELECT rondas_ganadas, rondas_perdidas, fecha 
     FROM partidas 
     WHERE id_usuario = ? 
     ORDER BY fecha DESC"
);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $partidas[] = $row;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Puntuación</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body class="bg-dark text-white">

<?php include 'vistas/sidebar.php'; ?>

<div class="container mt-5">

    <h2 class="text-center mb-4">Historial de partidas</h2>

    <?php if (count($partidas) > 0): ?>

        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                    <th>Rondas Ganadas</th>
                    <th>Rondas Perdidas</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($partidas as $p): ?>
                    <tr>
                        <td class="text-success">
                            <?php echo $p['rondas_ganadas'] ?? 0; ?>
                        </td>
                        <td class="text-danger">
                            <?php echo $p['rondas_perdidas'] ?? 0; ?>
                        </td>
                        <td>
                            <?php echo $p['fecha']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p class="text-center text-warning">
            No has jugado partidas aún.
        </p>

    <?php endif; ?>

</div>

<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>