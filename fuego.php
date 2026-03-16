<?php
include 'include/conect.php';
$consulta = "SELECT * FROM pokemon";
$resultado = $conexion->query($consulta);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Pokémon</title>
    <link rel="stylesheet" href="assets/css/fuego1.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
</head>
<body>
    <!--titulo-->
    <h1 class="titulo">Todos los Pokémon</h1>
   
    <!--contenedor-->
    <div class="contenedor">

<?php while($row = $resultado->fetch_assoc()){ ?>

    <div class="tarjeta">

        <div class="pokemon">
            <h3><?php echo $row['npoke']; ?></h3>

            <img src="assets/img/<?php echo $row['imagen']; ?>" width="150">

            <p><?php echo $row['descripcion']; ?></p>
        </div>

       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Charmander">
            Conoce Mas
        </button>

    </div>

<?php } ?>

</div>
    <!-- modal-->
     <div class="modal fade" id="Charmander" tabindex="-1" aria-labelledby="CharmanderLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Charmander</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

     <!-- modal-->
      <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>



