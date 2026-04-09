<?php if (session_status() === PHP_SESSION_NONE)
    session_start(); ?>
<?php
include 'include/conect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_companero'])) {
    $redirectId = isset($_GET['id_usuario']) ? (int) $_GET['id_usuario'] : 0;
    if (isset($_SESSION['id_usuario']) && (int) $_SESSION['id_usuario'] === $redirectId && $redirectId > 0) {
        $idPokePost = isset($_POST['id_poke']) ? trim((string) $_POST['id_poke']) : '';
        if ($idPokePost === '' || $idPokePost === '0') {
            $upd = $conexion->prepare('UPDATE usuarios SET id_poke_companero = NULL WHERE id_usuario = ?');
            $upd->bind_param('i', $redirectId);
            $upd->execute();
            $upd->close();
        } else {
            $idPoke = (int) $idPokePost;
            $chk = $conexion->prepare('SELECT id_poke FROM pokemon WHERE id_poke = ? LIMIT 1');
            $chk->bind_param('i', $idPoke);
            $chk->execute();
            $exists = $chk->get_result()->fetch_assoc();
            $chk->close();
            if ($exists) {
                $upd = $conexion->prepare('UPDATE usuarios SET id_poke_companero = ? WHERE id_usuario = ?');
                $upd->bind_param('ii', $idPoke, $redirectId);
                $upd->execute();
                $upd->close();
            }
        }
        header('Location: perfil.php?id_usuario=' . $redirectId);
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resetear_partidas'])) {
    $redirectId = isset($_GET['id_usuario']) ? (int) $_GET['id_usuario'] : 0;
    if (isset($_SESSION['id_usuario']) && (int) $_SESSION['id_usuario'] === $redirectId && $redirectId > 0) {
        $del = $conexion->prepare('DELETE FROM partidas WHERE id_usuario = ?');
        $del->bind_param('i', $redirectId);
        $del->execute();
        $del->close();
        header('Location: perfil.php?id_usuario=' . $redirectId);
        exit;
    }
}
$perfil = null;
$error = null;
$listaPokemon = [];

if (isset($_GET['id_usuario'])) {
    $Id = intval($_GET['id_usuario']);
    if ($Id > 0) {
        $stmt = $conexion->prepare(
            'SELECT u.id_usuario, u.nombre, u.ApellidoP, u.ApellidoM, u.id_poke_companero,
                    p.npoke AS poke_npoke, p.imagen AS poke_imagen
             FROM usuarios u
             LEFT JOIN pokemon p ON p.id_poke = u.id_poke_companero
             WHERE u.id_usuario = ?'
        );
        $stmt->bind_param('i', $Id);
        $stmt->execute();
        $res = $stmt->get_result();
        $perfil = $res->fetch_assoc();
        $stmt->close();
        if (!$perfil) {
            $error = 'No se encontró un usuario con ese ID.';
        }
        // Totales de partidas del usuario
$totalGanadas  = 0;
$totalPerdidas = 0;
if ($perfil) {
    $stmtP = $conexion->prepare(
        "SELECT 
            COALESCE(SUM(rondas_ganadas), 0)  AS total_ganadas,
            COALESCE(SUM(rondas_perdidas), 0) AS total_perdidas
         FROM partidas WHERE id_usuario = ?"
    );
    $stmtP->bind_param('i', $Id);
    $stmtP->execute();
    $resP = $stmtP->get_result()->fetch_assoc();
    $stmtP->close();
    $totalGanadas  = (int) $resP['total_ganadas'];
    $totalPerdidas = (int) $resP['total_perdidas'];
}
    } else {
        $error = 'ID de usuario no válido.';
    }
} else {
    $error = 'No se recibió el ID.';
}

$pokemonCompanero = null;
if ($perfil && !empty($perfil['poke_imagen'])) {
    $pokemonCompanero = [
        'npoke' => $perfil['poke_npoke'],
        'imagen' => $perfil['poke_imagen'],
    ];
}

if ($perfil && isset($_SESSION['id_usuario']) && (int) $_SESSION['id_usuario'] === (int) $perfil['id_usuario']) {
    $pokeListRes = $conexion->query('SELECT id_poke, npoke FROM pokemon ORDER BY npoke ASC');
    if ($pokeListRes) {
        while ($row = $pokeListRes->fetch_assoc()) {
            $listaPokemon[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil — POKEDEX</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .perfil-card {
            max-width: 920px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .perfil-pokemon-wrap {
            min-height: 280px;
            background: rgba(0, 0, 0, 0.35);
        }

        .perfil-pokemon-img {
            max-height: 340px;
            width: 100%;
            object-fit: contain;
        }

        @media (min-width: 768px) {
            .perfil-pokemon-wrap {
                min-height: 100%;
            }

            .perfil-pokemon-img {
                max-height: 420px;
            }
        }

        .perfil-datos {
            max-width: 100%;
            display: grid;
            grid-template-columns: max-content 1fr;
            column-gap: 1rem;
            align-items: center;
        }

        .perfil-fila {
            display: contents;
        }

        .perfil-etiqueta {
            text-align: left;
            white-space: nowrap;
            font-size: 1.15rem;
        }

        .perfil-valor {
            text-align: center;
            font-size: 1.35rem;
            font-weight: 500;
        }

        .perfil-datos dt,
        .perfil-datos dd {
            padding: 0.5rem 0;
            margin: 0;
        }

        .perfil-datos dt:nth-of-type(n + 2),
        .perfil-datos dd:nth-of-type(n + 2) {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .perfil-select-companero {
            max-width: 320px;
        }
    </style>
</head>

<body>
    <?php include 'vistas/sidebar.php'; ?>

    <div class="container contenido d-flex flex-column align-items-center justify-content-center py-4">
        <?php if ($perfil): ?>
            <?php
            $nombreCompleto = trim(
                ($perfil['nombre'] ?? '') . ' ' .
                    ($perfil['ApellidoP'] ?? '') . ' ' .
                    ($perfil['ApellidoM'] ?? '')
            );
            $sesionActivaParaPerfil = isset($_SESSION['id_usuario'])
                && (int) $_SESSION['id_usuario'] === (int) $perfil['id_usuario'];
            $apellidoP = trim($perfil['ApellidoP'] ?? '');
            $apellidoM = trim($perfil['ApellidoM'] ?? '');
            $idCompaneroGuardado = isset($perfil['id_poke_companero']) ? (int) $perfil['id_poke_companero'] : 0;
            ?>
            <div class="card perfil-card bg-dark bg-opacity-75 text-white border border-secondary shadow-lg w-100 overflow-hidden">
                <div class="row g-0">
                    <?php if ($pokemonCompanero && !empty($pokemonCompanero['imagen'])): ?>
                        <div class="col-md-5 d-flex align-items-center justify-content-center perfil-pokemon-wrap p-4 p-md-5">
                            <img src="assets/img/<?php echo htmlspecialchars($pokemonCompanero['imagen']); ?>"
                                class="perfil-pokemon-img"
                                alt="Pokémon: <?php echo htmlspecialchars($pokemonCompanero['npoke'] ?? ''); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo ($pokemonCompanero && !empty($pokemonCompanero['imagen'])) ? 'col-md-7' : 'col-12'; ?>">
                        <div class="card-body p-4 p-lg-5">
                            <h1 class="h3 card-title text-center mb-2">Perfil de entrenador</h1>
                            <p class="text-center text-white-50 lead mb-4"><?php echo htmlspecialchars($nombreCompleto); ?></p>

                            <?php if ($pokemonCompanero): ?>
                                <p class="text-center text-white-50 small mb-2">
                                    Compañero Pokémon:
                                    <span class="text-white fw-semibold"><?php echo htmlspecialchars($pokemonCompanero['npoke']); ?></span>
                                </p>
                            <?php elseif ($sesionActivaParaPerfil): ?>
                                <p class="text-center text-white-50 small mb-2">Aún no has elegido un compañero Pokémon.</p>
                            <?php endif; ?>

                            <?php if ($sesionActivaParaPerfil && count($listaPokemon) > 0): ?>
                                <form method="post" action="perfil.php?id_usuario=<?php echo (int) $perfil['id_usuario']; ?>"
                                    class="mx-auto mb-4 text-center perfil-select-companero">
                                    <label for="id_poke" class="form-label text-white-50 small mb-1">Elegir compañero</label>
                                    <select name="id_poke" id="id_poke" class="form-select form-select-sm bg-dark text-white border-secondary">
                                        <option value="">— Ninguno —</option>
                                        <?php foreach ($listaPokemon as $op): ?>
                                            <option value="<?php echo (int) $op['id_poke']; ?>"
                                                <?php echo $idCompaneroGuardado === (int) $op['id_poke'] ? ' selected' : ''; ?>>
                                                <?php echo htmlspecialchars($op['npoke']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" name="guardar_companero" value="1" class="btn btn-danger btn-sm mt-2 w-100">
                                        Guardar compañero
                                    </button>
                                </form>
                            <?php endif; ?>

                            <dl class="mb-0 perfil-datos mx-auto">
<<<<<<< HEAD
                                <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">ID</dt>
                                    <dd class="perfil-valor"><?php echo (int) $perfil['id_usuario']; ?></dd>
                                </div>
=======
                                <!-- <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">ID</dt>
                                    <dd class="perfil-valor"><?php echo (int) $perfil['id_usuario']; ?></dd>
                                </div> -->
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7

                                <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">Nombre</dt>
                                    <dd class="perfil-valor"><?php echo htmlspecialchars($perfil['nombre'] ?? ''); ?></dd>
                                </div>

                                <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">Apellido&nbsp;Paterno</dt>
                                    <dd class="perfil-valor"><?php echo htmlspecialchars($apellidoP); ?></dd>
                                </div>

                                <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">Apellido&nbsp;Materno</dt>
                                    <dd class="perfil-valor"><?php echo htmlspecialchars($apellidoM); ?></dd>
                                </div>

                                <div class="perfil-fila">
                                    <dt class="text-white-50 perfil-etiqueta">Estado</dt>
                                    <dd class="perfil-valor">
                                        <?php if ($sesionActivaParaPerfil): ?>
                                            <span class="text-success fw-semibold">Conectado</span>
                                        <?php else: ?>
                                            <span class="text-white-50">Desconectado</span>
                                        <?php endif; ?>
                                    </dd>
                                </div>
<<<<<<< HEAD
=======
                                <div class="perfil-fila">
    <dt class="text-white-50 perfil-etiqueta">Rondas&nbsp;Ganadas</dt>
    <dd class="perfil-valor">
        <span class="text-success fw-bold"><?php echo $totalGanadas; ?></span>
    </dd>
</div>

<div class="perfil-fila">
    <dt class="text-white-50 perfil-etiqueta">Rondas&nbsp;Perdidas</dt>
    <dd class="perfil-valor">
        <span class="text-danger fw-bold"><?php echo $totalPerdidas; ?></span>
    </dd>
</div>
<?php if ($sesionActivaParaPerfil): ?>
<div class="perfil-fila">
    <dt class="text-white-50 perfil-etiqueta"></dt>
    <dd class="perfil-valor">
        <form method="post" action="perfil.php?id_usuario=<?php echo (int) $perfil['id_usuario']; ?>"
              onsubmit="return confirm('¿Seguro que quieres reiniciar tus partidas?')">
            <button type="submit" name="resetear_partidas" value="1"
                    class="btn btn-danger btn-sm mt-1">
                Reiniciar
            </button>
        </form>
    </dd>
</div>
<?php endif; ?>
>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning shadow perfil-card w-100" role="alert">
                <?php echo htmlspecialchars($error ?? 'No se pudo cargar el perfil.'); ?>
            </div>
            <a href="index.php" class="btn btn-outline-light mt-3">Volver al inicio</a>
        <?php endif; ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
