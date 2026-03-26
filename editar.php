<?php
include 'include/conect.php';

$Id = intval($_GET['id_poke']);

$editar = "SELECT * FROM pokemon WHERE id_poke = $Id";
$editare = $conexion->query($editar);
$row = $editare->fetch_assoc();
$Mensaje = "";
// Obetener los datos
if(isset($_POST['BtnActualizar'])){

$identifica = $_POST['id_poke'];
$npoke = $conexion->real_escape_string($_POST['npoke']);
$id_tpoke = $conexion->real_escape_string($_POST['id_tpoke']);
$id_sexo = $conexion->real_escape_string($_POST['id_sexo']);
$descripcion = $conexion->real_escape_string($_POST['descripcion']);
$id_region = $conexion->real_escape_string($_POST['id_region']);
$peso = $conexion->real_escape_string($_POST['peso']);
$altura = $conexion->real_escape_string($_POST['altura']);
$legendario = $conexion->real_escape_string($_POST['legendario']);
// actualizar
if($npoke == ""){
    $Mensaje.="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
<strong>El nombre el obligatorio</strong>.
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
else{
$update = "UPDATE pokemon SET 
npoke='$npoke',
id_tpoke='$id_tpoke',
id_sexo='$id_sexo',
descripcion='$descripcion',
id_region='$id_region',
peso='$peso',
altura='$altura',
legendario='$legendario'
WHERE id_poke='$identifica'";
$updatex = $conexion->query($update);
if($updatex){
        header("Location: control.php?actualizacion=exitosa");
        exit();
}
else {
    echo "<div class='container mt-3'>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error al actualizar.</strong> Intentalo mas tarde.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>
          </div>";

    echo "<script>
            if(window.history.replaceState){
                window.history.replaceState(null, null, window.location.pathname);
            }
          </script>";
}
}
if(!$Id){
    die("ID no válido");
}
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Pokémon</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<style>
body{
    background: linear-gradient(to right, #ffecd2, #fcb69f);
}
.card{
    border-radius: 20px;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
}
</style>
</head>

<body>
    <!--Inicia el sidebar-->
<!-- include 'vistas/sidebar.php -->

<div class="container mt-5">

<?php echo $Mensaje; ?>

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card p-4">

<div class="text-center">
<h2 class="mt-2">Editar Pokémon</h2>
<p>Modifica los datos del Pokémon</p>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<input type="hidden" name="id_poke" value="<?php echo $row['id_poke']; ?>">

<div class="row mt-3">
<div class="col">
<input type="text" name="npoke" class="form-control"
value="<?php echo $row['npoke']; ?>" placeholder="Nombre del Pokémon">
</div>
</div>

<div class="row mt-3">
<div class="col">
<input type="text" name="id_tpoke" class="form-control"
value="<?php echo $row['id_tpoke']; ?>" placeholder="Tipo de Pokémon">
</div>
<div class="col">
<input type="text" name="id_sexo" class="form-control"
value="<?php echo $row['id_sexo']; ?>" placeholder="Sexo">
</div>
</div>

<div class="row mt-3">
<div class="col">
<textarea name="descripcion" class="form-control" placeholder="Descripción"><?php echo $row['descripcion']; ?></textarea>
</div>
</div>

<div class="row mt-3">
<div class="col">
<input type="text" name="id_region" class="form-control"
value="<?php echo $row['id_region']; ?>" placeholder="Región">
</div>
</div>

<div class="row mt-3">
<div class="col">
<input type="text" name="peso" class="form-control"
value="<?php echo $row['peso']; ?>" placeholder="Peso">
</div>
<div class="col">
<input type="text" name="altura" class="form-control"
value="<?php echo $row['altura']; ?>" placeholder="Altura">
</div>
</div>

<div class="row mt-3">
<div class="col">
<select name="legendario" class="form-control">
<option value="">¿Es legendario?</option>
<option value="1" <?php if($row['legendario']==1) echo "selected"; ?>>Sí</option>
<option value="0" <?php if($row['legendario']==0) echo "selected"; ?>>No</option>
</select>
</div>
</div>

<div class="row mt-3">
<input type="submit" value="Actualizar" name="BtnActualizar" class="btn btn-warning">
</div>

</form>

</div>
</div>
</div>
</div>

<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>