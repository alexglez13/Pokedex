<?php

// CONEXIÓN
require 'include/conect.php';

// MENSAJE
$Mensaje = "";

// BOTÓN
if(isset($_POST['BtnRegistro'])){

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
(npoke,id_tpoke,id_sexo,descripcion,id_region,peso,altura,legendario)
VALUES 
('$npoke','$id_tpoke','$id_sexo','$descripcion','$id_region','$peso','$altura','$legendario')";


       $RegistroE = $conexion->query($registra);
// RESULTADO
if($RegistroE){
    $Mensaje.="<div class='alert alert-success alert-dismissible fade show' role='alert'>
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
        body{
            background: linear-gradient(to right, #ffecd2, #fcb69f);
        }
        .card{
            border-radius: 20px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
        }
        .pokemon-img{
            width: 100px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
       <?php echo $Mensaje; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card p-4">

                <div class="text-center">
                   
                    <h2 class="mt-2">Registro de Pokémon</h2>
                    <p>Ingresa los datos del Pokémon</p>
                </div>

                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" name="npoke" placeholder="Nombre del Pokémon" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                           <input type="text" name="id_tpoke" placeholder="Tipo de Pokémon" class="form-control">
                        </div>
                        <div class="col">
                            <input type="text" name="id_sexo" placeholder="Sexo" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <textarea name="descripcion" placeholder="Descripción" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" name="id_region" placeholder="Región" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <input type="text" name="peso" placeholder="Peso" class="form-control">
                        </div>
                        <div class="col">
                            <input type="text" name="altura" placeholder="Altura" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <select name="legendario" class="form-control">
                                <option value="">¿Es legendario?</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                         <div class="row mt-2">
        <input type="submit" value="Registrar" name="BtnRegistro" class="btn btn-info">
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