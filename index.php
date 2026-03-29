<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>POKEDEX</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4)),
                url('assets/img/made-this-pokeball-wallpaper-for-fun-2560-x-1440-will-take-v0-f2Dek-N2L1qqxugRbpozk_SapDPku3Aa8FLHu9c_VBA.webp') no-repeat center center/cover;
            height: 100vh;
            color: white;
        }

        /* Centrado vertical */
        .contenido {
            height: 90vh;
        }

        /* Efecto botón */
        .btn-custom {
            padding: 10px 30px;
            font-size: 18px;
            border-radius: 30px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <!-- navbar -->
 <?php include 'vistas/sidebar.php';?>
    <!-- CONTENIDO -->
    <div class="container contenido d-flex flex-column justify-content-center align-items-center text-center">
        <p align="center">
            <img height="550px" src="assets/img/upscalemedia-transformed-Photoroom (1).png" class="mt-4" />
        </p>
        <h1 class="display-3 fw-bold">¡Bienvenidos al mundo Pokémon!</h1>

        <p class="lead mt-2">
            Podrás conocer más sobre tus personajes favoritos
        </p>

        <a href="todos.php" class="btn btn-danger btn-custom mt-2">
            TODOS LOS POKEMON
        </a>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>