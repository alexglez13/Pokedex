<!-- Ordenar pokemon -->
<?php
$orden = "pokemon.id_poke";
$direccion = "ASC";
if (isset($_GET['orden'])) {
    $orden = $_GET['orden'];
}
if (isset($_GET['direccion'])) {
    $direccion = $_GET['direccion'];
}
?>

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
ORDER BY $orden $direccion";
$resultado = $conexion->query($consulta);

// Guardamos todos los pokemon en un array para pasarlos a JS
$todosPokemon = [];
while ($row = $resultado->fetch_assoc()) {
    $todosPokemon[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
</head>

<body class="bg-pokedex">

    <?php include 'vistas/sidebar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center text-light mb-2">Selecciona tu Pokemon</h1>
        <p class="text-center text-warning mb-4">¡Haz clic en una tarjeta para iniciar la batalla!</p>

        <!-- CARRUSEL -->
         <!-- Intervalo de tiempo -->
         <!-- data-bs-interval="3000" -->
        <div id="carouselPokemon" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
                $contador = 0;
                foreach ($todosPokemon as $row) {

                    switch ($row['ntpoke']) {
                        case "Agua":
                            $colorTipo = "bg-primary";
                            break;
                        case "Fuego":
                            $colorTipo = "bg-danger";
                            break;
                        case "Planta":
                            $colorTipo = "bg-success";
                            break;
                            case "Electrico":
                            $colorTipo = "bg-warning";
                            break;
                        default:
                            $colorTipo = "bg-secondary";
                    }
                    switch ($row['ntpoke']) {
                        case "Agua":
                            $fondoTipo = "shadow bg-light border-5 border-primary text-dark";
                            break;
                        case "Fuego":
                            $fondoTipo = "shadow bg-light border-5 border-danger text-dark";
                            break;
                        case "Planta":
                            $fondoTipo = "shadow bg-light border-5 border-success text-dark";
                            break;
                            case "Electrico":
                            $fondoTipo = "shadow bg-light border-5 border-warning text-dark";
                            break;
                        default:
                            $fondoTipo = "bg-light border-5 border-secondary text-dark";
                    }

                    if ($contador % 3 == 0) {
                        echo '<div class="carousel-item ' . ($contador == 0 ? 'active' : '') . '">';
                        echo '<div class="row justify-content-center">';
                    }
                    ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <!-- onclick pasa todos los datos del pokemon al JS -->
                        <div class="card shadow h-100 text-center card-hover <?php echo $fondoTipo; ?>" onclick="seleccionarPokemon(
                         <?php echo $row['id_poke']; ?>,
                         '<?php echo addslashes($row['npoke']); ?>',
                         '<?php echo $row['imagen']; ?>',
                         '<?php echo addslashes($row['ntpoke']); ?>',
                         '<?php echo addslashes($row['nregion']); ?>',
                         <?php echo $row['legendario']; ?>
                     )">
                            <h5 class="card-title mt-4 text-uppercase text-center">
                                <span class="fs-10 fw-bold"><?php echo $row['npoke']; ?></span>
                            </h5>
                            <img src="assets/img/<?php echo $row['imagen']; ?>" class="card-img-top mt-2 p-3"
                                style="height:350px; object-fit:contain;">
                            <div class="card-body">
                                <span class="badge <?php echo $colorTipo; ?> fs-6">
                                    <?php echo $row['ntpoke']; ?>
                                </span>
                                <?php if ($row['legendario'] == 1): ?>
                                    <br><span class="badge bg-warning text-dark mt-1">⭐ Legendario</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $contador++;
                    if ($contador % 3 == 0) {
                        echo '</div></div>';
                    }
                }
                if ($contador % 3 != 0) {
                    echo '</div></div>';
                }
                ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPokemon" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselPokemon" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- ===== MODAL DE BATALLA ===== -->
    <div class="modal fade" id="modalBatalla" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">¡Batalla Pokémon!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <!-- Contendientes -->
                    <div class="row align-items-center text-center mb-3">
                        <div class="col-5">
                            <p class="fw-bold mb-1">TÚ</p>
                            <img id="imgJugador" src="" class="sprite-batalla">
                            <p id="nombreJugador" class="fw-bold mt-1 text-primary"></p>
                        </div>
                        <div class="col-2">
                            <span class="vs-text">VS</span>
                        </div>
                        <div class="col-5">
                            <p class="fw-bold mb-1">CPU</p>
                            <img id="imgCPU" src="" class="sprite-batalla">
                            <p id="nombreCPU" class="fw-bold mt-1 text-danger"></p>
                        </div>
                    </div>

                    <hr>

                    <!-- Marcador -->
                    <div class="text-center mb-3">
                        <span class="badge bg-primary fs-5 me-3">Tú: <span id="puntosJugador">0</span></span>
                        <span class="badge bg-danger fs-5">CPU: <span id="puntosCPU">0</span></span>
                    </div>

                    <!-- Historial de rondas -->
                    <div id="historialRondas" class="text-center mb-3"></div>

                    <!-- Área de dados -->
                    <div class="row text-center" id="areaDados">
                        <div class="col-5">
                            <div class="dado" id="dadoJugador">🎲</div>
                            <p id="valorDadoJugador" class="fw-bold fs-4 text-primary"></p>
                        </div>
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <span class="fw-bold text-muted">VS</span>
                        </div>
                        <div class="col-5">
                            <div class="dado" id="dadoCPU">🎲</div>
                            <p id="valorDadoCPU" class="fw-bold fs-4 text-danger"></p>
                        </div>
                    </div>

                    <!-- Resultado de la ronda -->
                    <div id="resultadoRonda" class="text-center mt-2 fs-5 fw-bold"></div>

                    <!-- Resultado final -->
                    <div id="resultadoFinal" class="text-center d-none"></div>

                </div>

                <div class="modal-footer justify-content-center">
                    <button id="btnTirar" class="btn btn-danger btn-lg px-5" onclick="tirarDado()">
                        🎲 ¡Tirar Dado!
                    </button>
                    <button id="btnReintentar" class="btn btn-secondary btn-lg px-4 d-none"
                        data-bs-dismiss="modal">
                        Volver a elegir
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Array con todos los pokemon para que la CPU pueda elegir -->
    <script>
        const todosLosPokemon = <?php echo json_encode($todosPokemon); ?>;
    </script>

    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/batalla.js"></script>
</body>

</html>