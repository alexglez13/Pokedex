<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

include 'conect.php';

if (isset($_GET['id'])) {
    $id_usuario = intval($_GET['id']);
    
    // Prevenir que un usuario se elimine a sí mismo
    if ($id_usuario == $_SESSION['id_usuario']) {
        header('Location: ../control_usuarios.php?error=self_delete');
        exit;
    }
    
    // Eliminar el usuario
    $query = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
    
    if ($conexion->query($query)) {
        header('Location: ../control_usuarios.php?eliminacion=exitosa');
    } else {
        header('Location: ../control_usuarios.php?error=eliminacion');
    }
} else {
    header('Location: ../control_usuarios.php');
}

$conexion->close();
?>
