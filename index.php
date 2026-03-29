<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>POKEDEX</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body>
    <?php include 'vistas/sidebar.php'; ?>
    <div class="container contenido d-flex flex-column justify-content-center align-items-center text-center">
        <img src="assets/img/upscalemedia-transformed-Photoroom (1).png" class="pokemon-hero mt-3" />
        <h1 class="display-3 fw-bold mt-2">¡Bienvenidos al mundo Pokémon!</h1>
        <p class="lead mt-2">
            Podrás conocer más sobre tus personajes favoritos
        </p>
        <a href="todos.php" class="btn btn-danger btn-custom mt-2">
            TODOS LOS POKEMON
        </a>
    </div>
    <script src="assets/js/bootstrap.bundle.min"></script>
</body>

</html>