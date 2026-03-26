<?php

// CONEXIÓN
require 'include/conect.php';

// MENSAJE
$Mensaje = "";
// BOTÓN
if (isset($_POST['BtnRegistro'])) {
    // IMAGEN
    $nombreImagen = $_FILES['imagen']['name'];
    $tempImagen = $_FILES['imagen']['tmp_name'];
    $ruta = "assets/img/" . $nombreImagen;

    // Mover imagen a carpeta
    move_uploaded_file($tempImagen, $ruta);
    // 
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {

        $nombreImagen = $_FILES['imagen']['name'];
        $tempImagen = $_FILES['imagen']['tmp_name'];

        // Validar tipo
        $tipo = $_FILES['imagen']['type'];

        if ($tipo == "image/jpeg" || $tipo == "image/png" || $tipo == "image/jpg") {

            $ruta = "assets/img/" . $nombreImagen;
            move_uploaded_file($tempImagen, $ruta);

        } else {
            echo "Solo se permiten imágenes JPG o PNG";
        }
    }
    // 

    $nombreImagen = $_FILES['imagen']['name'];
    // RECIBIR DATOS
    $npoke = $conexion->real_escape_string($_POST['npoke']);
    $id_tpoke = $conexion->real_escape_string($_POST['id_tpoke']);
    $id_sexo = $conexion->real_escape_string($_POST['id_sexo']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $id_region = $conexion->real_escape_string($_POST['id_region']);
    $peso = $conexion->real_escape_string($_POST['peso']);
    $altura = $conexion->real_escape_string($_POST['altura']);
    $legendario = $conexion->real_escape_string($_POST['legendario']);


    // INSERT CORRECTO
    $registra = "INSERT INTO pokemon 
(npoke,id_tpoke,id_sexo,descripcion,id_region,peso,altura,legendario,imagen)
VALUES 
('$npoke','$id_tpoke','$id_sexo','$descripcion','$id_region','$peso','$altura','$legendario','$nombreImagen')";


    $RegistroE = $conexion->query($registra);
    // RESULTADO
    if ($RegistroE) {
        $Mensaje .= "<div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>Registro Exitoso! </strong> Los datos estan en la base de manera correcta 
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";

    }

}

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

        .pokemon-img {
            width: 100px;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <?php include 'vistas/sidebar.php';?>

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
                            <div class="col">
                                <select name="id_tpoke" class="form-select">
                                    <option value="">Tipo de Pokémon</option>
                                    <option value="1">Planta</option>
                                    <option value="2">Fuego</option>
                                    <option value="3">Agua</option>
                                    <option value="4">Roca</option>
                                </select>
                            </div>
                            <div class="col">
                                <select name="id_sexo" class="form-select">
                                    <option value="">Sexo</option>
                                    <option value="1">Macho</option>
                                    <option value="2">Hembra</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <textarea name="descripcion" placeholder="Descripción" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <select name="id_region" class="form-select">
                                    <option value="">Región</option>
                                    <option value="1">Bosque</option>
                                    <option value="2">Playa</option>
                                    <option value="3">Volcán</option>
                                    <option value="4">Desierto</option>
                                    <option value="5">Pradera</option>
                                    <option value="6">Estanque</option>
                                </select>
                            </div>
                        </div>

                        <input type="number" name="peso" placeholder="Peso (kg)" class="form-control" step="0.01"
                            min="0">
                        <input type="number" name="altura" placeholder="Altura (m)" class="form-control" step="0.01"
                            min="0">

                        <div class="row mt-3">
                            <div class="col">
                                <select name="legendario" class="form-control">
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

                        <div class="row mt-2">
                            <input type="submit" value="Registrar" name="BtnRegistro" class="btn btn-warning">
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