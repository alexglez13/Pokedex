<?php
session_start();
include 'include/conect.php';

if (isset($_SESSION['id_usuario'])) {

    $id_usuario = $_SESSION['id_usuario'];
    $ganadas = intval($_POST['ganadas']);
    $perdidas = intval($_POST['perdidas']);

    $stmt = $conexion->prepare(
        "INSERT INTO partidas (id_usuario, rondas_ganadas, rondas_perdidas) 
         VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iii", $id_usuario, $ganadas, $perdidas);
    $stmt->execute();
    $stmt->close();
}
?>