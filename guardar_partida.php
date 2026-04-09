<?php
session_start();
include 'include/conect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['ok' => false, 'error' => 'No autenticado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$id_usuario      = $_SESSION['id_usuario'];
$rondas_ganadas  = intval($data['rondas_ganadas'] ?? 0);
$rondas_perdidas = intval($data['rondas_perdidas'] ?? 0);

$stmt = $conexion->prepare(
    "INSERT INTO partidas (id_usuario, rondas_ganadas, rondas_perdidas)
     VALUES (?, ?, ?)"
);
$stmt->bind_param("iii", $id_usuario, $rondas_ganadas, $rondas_perdidas);

if ($stmt->execute()) {
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'error' => $stmt->error]);
}

$stmt->close();
?>