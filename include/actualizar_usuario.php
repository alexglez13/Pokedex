<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

include 'conect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = intval($_POST['id_usuario']);
    $nombre = $conexion->real_escape_string(trim($_POST['nombre']));
    $apellidoP = $conexion->real_escape_string(trim($_POST['apellidoP']));
    $apellidoM = $conexion->real_escape_string(trim($_POST['apellidoM']));
    $email = $conexion->real_escape_string(trim($_POST['email']));
    $rol = $conexion->real_escape_string($_POST['rol']);
    $id_poke_companero = !empty($_POST['id_poke_companero']) ? intval($_POST['id_poke_companero']) : NULL;
    
    // Verificar si se proporcionó una nueva contraseña
    $password = trim($_POST['password']);
    
    // Validar que el email no esté duplicado (excluyendo el usuario actual)
    $query_check = "SELECT id_usuario FROM usuarios WHERE email = '$email' AND id_usuario != $id_usuario";
    $result_check = $conexion->query($query_check);
    
    if ($result_check->num_rows > 0) {
        header('Location: ../editar_usuario.php?id_usuario=' . $id_usuario . '&error=email_duplicado');
        exit;
    }
    
    // Construir la consulta de actualización
    if (!empty($password)) {
        // Si hay una nueva contraseña, actualizarla también
        $password_escaped = $conexion->real_escape_string($password);
        
        if ($id_poke_companero !== NULL) {
            $query = "UPDATE usuarios SET 
                      nombre = '$nombre',
                      ApellidoP = '$apellidoP',
                      ApellidoM = '$apellidoM',
                      email = '$email',
                      password = '$password_escaped',
                      rol = '$rol',
                      id_poke_companero = $id_poke_companero
                      WHERE id_usuario = $id_usuario";
        } else {
            $query = "UPDATE usuarios SET 
                      nombre = '$nombre',
                      ApellidoP = '$apellidoP',
                      ApellidoM = '$apellidoM',
                      email = '$email',
                      password = '$password_escaped',
                      rol = '$rol',
                      id_poke_companero = NULL
                      WHERE id_usuario = $id_usuario";
        }
    } else {
        // Sin cambio de contraseña
        if ($id_poke_companero !== NULL) {
            $query = "UPDATE usuarios SET 
                      nombre = '$nombre',
                      ApellidoP = '$apellidoP',
                      ApellidoM = '$apellidoM',
                      email = '$email',
                      rol = '$rol',
                      id_poke_companero = $id_poke_companero
                      WHERE id_usuario = $id_usuario";
        } else {
            $query = "UPDATE usuarios SET 
                      nombre = '$nombre',
                      ApellidoP = '$apellidoP',
                      ApellidoM = '$apellidoM',
                      email = '$email',
                      rol = '$rol',
                      id_poke_companero = NULL
                      WHERE id_usuario = $id_usuario";
        }
    }
    
    if ($conexion->query($query)) {
        header('Location: ../control_usuarios.php?actualizacion=exitosa');
    } else {
        header('Location: ../editar_usuario.php?id_usuario=' . $id_usuario . '&error=actualizacion');
    }
} else {
    header('Location: ../control_usuarios.php');
}

$conexion->close();
?>
