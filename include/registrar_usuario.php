<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

include 'conect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $conexion->real_escape_string(trim($_POST['nombre']));
    $apellidoP = $conexion->real_escape_string(trim($_POST['apellidoP']));
    $apellidoM = $conexion->real_escape_string(trim($_POST['apellidoM']));
    $email = $conexion->real_escape_string(trim($_POST['email']));
    $password = $conexion->real_escape_string(trim($_POST['password']));
    $confirm_password = trim($_POST['confirm_password']);
    $rol = $conexion->real_escape_string($_POST['rol']);
    $id_poke_companero = !empty($_POST['id_poke_companero']) ? intval($_POST['id_poke_companero']) : NULL;
    
    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        header('Location: ../crear_usuario.php?error=password_mismatch');
        exit;
    }
    
    // Validar que el email no esté duplicado
    $query_check = "SELECT id_usuario FROM usuarios WHERE email = '$email'";
    $result_check = $conexion->query($query_check);
    
    if ($result_check->num_rows > 0) {
        header('Location: ../crear_usuario.php?error=email_duplicado');
        exit;
    }
    
    // Insertar el nuevo usuario
    if ($id_poke_companero !== NULL) {
        $query = "INSERT INTO usuarios (nombre, ApellidoP, ApellidoM, email, password, rol, id_poke_companero) 
                  VALUES ('$nombre', '$apellidoP', '$apellidoM', '$email', '$password', '$rol', $id_poke_companero)";
    } else {
        $query = "INSERT INTO usuarios (nombre, ApellidoP, ApellidoM, email, password, rol, id_poke_companero) 
                  VALUES ('$nombre', '$apellidoP', '$apellidoM', '$email', '$password', '$rol', NULL)";
    }
    
    if ($conexion->query($query)) {
        header('Location: ../control_usuarios.php?creacion=exitosa');
    } else {
        header('Location: ../crear_usuario.php?error=creacion');
    }
} else {
    header('Location: ../control_usuarios.php');
}

$conexion->close();
?>
