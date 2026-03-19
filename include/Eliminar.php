<?php 
include 'conect.php';
$Id = $_GET['id'];
$Eliminar = "DELETE FROM pokemon WHERE id_poke = $Id";
$EliminarE = $conexion->query($Eliminar);
if($EliminarE > 0){
    header("location: control.php");
} 
?>