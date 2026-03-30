<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<?php
include 'include/conect.php';
if (isset($_GET['id_usuario'])) {
    $Id = intval($_GET['id_usuario']);
    echo "ID: " . $Id. " ";
    $Perfil = "SELECT * FROM usuarios WHERE id_usuario = $Id";
    $Perfile = $conexion->query($Perfil);
    $Perfile = $Perfile->fetch_assoc();
    echo $Perfile["nombre"]." ".$Perfile["ApellidoP"]." ".$Perfile["ApellidoM"];   
} else {
    echo "No se recibió el ID";
}
?>
    