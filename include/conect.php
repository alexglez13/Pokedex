<?php
$servidor = "localhost";
$usuario = "root";
$pass = "";
$bd = "pokedex";
$alerta = "";

$conexion = new mysqli($servidor, $usuario, $pass, $bd);
if ($conexion->connect_error) {
    die("Error al conectar la base de datos" . $conexion->connect_error);


}
$alerta = "se conecto a la base de datos";
?>