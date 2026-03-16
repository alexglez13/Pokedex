<?php
include 'include/conect.php';
$consulta = "SELECT 
pokemon.*, 
tipopoke.ntpoke,
sexo.nsexo,
region.nregion,
habilidad.nhabilidad
FROM pokemon
INNER JOIN tipopoke ON pokemon.id_tpoke = tipopoke.id_tpoke
INNER JOIN sexo ON pokemon.id_sexo = sexo.id_sexo
INNER JOIN region ON pokemon.id_region = region.id_region
INNER JOIN habilidad ON tipopoke.id_habilidad = habilidad.id_habilidad
ORDER BY pokemon.id_poke ASC";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Todos los Pokémon</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
<h1 class="text-center mb-5">Todos los Pokémon</h1>
<div class="row g-4">
<?php while($row = $resultado->fetch_assoc()){ ?>
<?php
switch($row['ntpoke']){
    case "Agua": $colorTipo = "bg-primary"; break;
    case "Fuego": $colorTipo = "bg-danger"; break;
    case "Planta": $colorTipo = "bg-success"; break;
    default: $colorTipo = "bg-secondary";
}
?>
<?php
$fondoTipo = "";

switch($row['ntpoke']){
    case "Agua":
        $fondoTipo = "bg-primary text-white";
        break;

    case "Fuego":
        $fondoTipo = "bg-danger text-white";
        break;

    case "Planta":
        $fondoTipo = "bg-success text-white";
        break;

    default:
        $fondoTipo = "bg-light";
}
?>
<div class="col-12 col-md-6 col-lg-4">
<div class="card shadow h-100 text-center <?php echo $fondoTipo; ?>">
<h5 class="card-title mt-4 text-uppercase text-center">
<span class="fs-10 fw-bold">
<?php echo $row['npoke']; ?>
</span>
</h5>
<img src="assets/img/<?php echo $row['imagen']; ?>" 
class="card-img-top mt-2 p-3"
style="height:350px; object-fit:contain;">
<div class="card-body">
<button type="button" 
class="btn btn-outline-light mt-2" 
data-bs-toggle="modal" 
data-bs-target="#modal<?php echo $row['id_poke']; ?>">
Conoce Más
</button>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal<?php echo $row['id_poke']; ?>" tabindex="-1">

<div class="modal-dialog modal-dialog-centered">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
<?php echo $row['npoke']; ?>
</h5>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>

</div>

<div class="modal-body text-center">

<img src="assets/img/<?php echo $row['imagen']; ?>" width="300">

<p class="mt-3">
<?php echo $row['descripcion']; ?>
</p>
<p class="mt-3">
<?php echo "Peso ".$row['peso']." Kg"; ?>
</p>
<p class="mt-1">
<?php echo "Altura ".$row['altura']." mts"; ?>
</p>
<p class="badge <?php echo $colorTipo; ?> fs-6">Tipo: <?php echo $row['ntpoke']; ?>
</p>
<p>
Sexo: <?php echo $row['nsexo']; ?>
</p>
<p>
Región: <?php echo $row['nregion']; ?>
</p>
<p>
Habilidad: <?php echo $row['nhabilidad']; ?>
</p>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>