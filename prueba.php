<?php
session_start();
<<<<<<< HEAD
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'editor') {
=======
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'editor')) {
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
    header('Location: index.php');
    exit;
}
?>
<?php

require 'include/conect.php';

$Mensaje = "";

if (isset($_POST['BtnRegistro'])) {

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombreImagen = $_FILES['imagen']['name'];
        $tempImagen = $_FILES['imagen']['tmp_name'];
        $tipo = $_FILES['imagen']['type'];

        if ($tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/jpg") {
            $ruta = "assets/img/" . $nombreImagen;
            move_uploaded_file($tempImagen, $ruta);
        } else {
            $Mensaje .= "<div class='alert alert-danger'>Solo se permiten imágenes JPG o PNG</div>";
        }
    }

    $nombreImagen = $conexion->real_escape_string($_FILES['imagen']['name']);
    $npoke = $conexion->real_escape_string($_POST['npoke']);
    $id_tpoke = $conexion->real_escape_string($_POST['id_tpoke']);
    $id_sexo = $conexion->real_escape_string($_POST['id_sexo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $id_region = $conexion->real_escape_string($_POST['id_region']);
    $peso = $conexion->real_escape_string($_POST['peso']);
    $altura = $conexion->real_escape_string($_POST['altura']);
    $legendario = $conexion->real_escape_string($_POST['legendario']);

    $registra = "INSERT INTO pokemon 
        (npoke, id_tpoke, id_sexo, descripcion, id_region, peso, altura, legendario, imagen)
        VALUES 
        ('$npoke','$id_tpoke','$id_sexo','$descripcion','$id_region','$peso','$altura','$legendario','$nombreImagen')";

    $RegistroE = $conexion->query($registra);

    if ($RegistroE) {
        $Mensaje .= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Registro Exitoso!</strong> Los datos están en la base de manera correcta.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    }
}

// ── Consultas para los selects ────────────────────────────────────────
$tipos = $conexion->query("SELECT id_tpoke, ntpoke FROM tipopoke ORDER BY ntpoke");
$sexos = $conexion->query("SELECT id_sexo, nsexo FROM sexo ORDER BY nsexo");
$regiones = $conexion->query("SELECT id_region, nregion FROM region ORDER BY nregion");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Pokémon</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ffecd2, #fcb69f);
        }

        .card {
            border-radius: 20px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container mt-5">
        <?php echo $Mensaje; ?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">

                    <div class="text-center">
                        <h2 class="mt-2">Registro de Pokémon</h2>
                        <p>Ingresa los datos del Pokémon</p>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                        <div class="row mt-3">
                            <div class="col">
                                <input type="text" name="npoke" placeholder="Nombre del Pokémon" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <!-- Select TIPO desde BD -->
                            <div class="col">
                                <select name="id_tpoke" class="form-select">
                                    <option value="">Tipo de Pokémon</option>
                                    <?php while ($t = $tipos->fetch_assoc()): ?>
                                        <option value="<?php echo $t['id_tpoke']; ?>">
                                            <?php echo $t['ntpoke']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Select SEXO desde BD -->
                            <div class="col">
                                <select name="id_sexo" class="form-select">
                                    <option value="">Sexo</option>
                                    <?php while ($s = $sexos->fetch_assoc()): ?>
                                        <option value="<?php echo $s['id_sexo']; ?>">
                                            <?php echo $s['nsexo']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <textarea name="descripcion" placeholder="Descripción" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Select REGIÓN desde BD -->
                        <div class="row mt-3">
                            <div class="col">
                                <select name="id_region" class="form-select">
                                    <option value="">Región</option>
                                    <?php while ($r = $regiones->fetch_assoc()): ?>
                                        <option value="<?php echo $r['id_region']; ?>">
                                            <?php echo $r['nregion']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <input type="number" name="peso" placeholder="Peso (kg)" class="form-control"
                                    step="0.01" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="altura" placeholder="Altura (m)" class="form-control"
                                    step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Legendario sigue hardcodeado: solo hay 2 opciones fijas (Sí/No) -->
                        <div class="row mt-3">
                            <div class="col">
                                <select name="legendario" class="form-select">
                                    <option value="">¿Es legendario?</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <input type="file" name="imagen" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <input type="submit" value="Registrar" name="BtnRegistro" class="btn btn-warning w-100">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>