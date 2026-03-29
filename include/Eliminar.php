<?php
include 'conect.php';

if (isset($_GET['id'])) {
    $id = $conexion->real_escape_string($_GET['id']);
    $EliminarE = $conexion->query("DELETE FROM pokemon WHERE id_poke = '$id'");

    if ($EliminarE) {
        header("Location: ../control.php?eliminacion=exitosa");
    } else {
        header("Location: ../control.php");
    }
    exit;
}
?>