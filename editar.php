<?php
session_start();
<<<<<<< HEAD
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'editor') {
    header('Location: index.php');
    exit;
}

require 'include/conect.php';

$Mensaje = '';
$row = null;
$Id = isset($_GET['id_poke']) ? (int) $_GET['id_poke'] : 0;

if ($Id > 0) {
    $stmtLoad = $conexion->prepare('SELECT * FROM pokemon WHERE id_poke = ? LIMIT 1');
    $stmtLoad->bind_param('i', $Id);
    $stmtLoad->execute();
    $row = $stmtLoad->get_result()->fetch_assoc();
    $stmtLoad->close();
}

if (isset($_POST['BtnActualizar']) && $row) {
    $identifica = (int) ($_POST['id_poke'] ?? 0);
    if ($identifica !== (int) $row['id_poke']) {
        $Mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error de validación.</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    } else {
        $npoke = trim($_POST['npoke'] ?? '');
        $id_tpoke = (int) ($_POST['id_tpoke'] ?? 0);
        $id_sexo = (int) ($_POST['id_sexo'] ?? 0);
        $descripcion = $_POST['descripcion'] ?? '';
        $id_region = (int) ($_POST['id_region'] ?? 0);
        $peso = (float) ($_POST['peso'] ?? 0);
        $altura = (float) ($_POST['altura'] ?? 0);
        $legendario = isset($_POST['legendario']) && $_POST['legendario'] !== '' ? (int) $_POST['legendario'] : null;

        $nuevaImagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tipo = $_FILES['imagen']['type'];
            if ($tipo === 'image/jpeg' || $tipo === 'image/png' || $tipo === 'image/jpg') {
                $nombreImagen = basename($_FILES['imagen']['name']);
                $ruta = 'assets/img/' . $nombreImagen;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
                    $nuevaImagen = $nombreImagen;
                } else {
                    $Mensaje .= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        No se pudo guardar la imagen. Se mantuvo la anterior.
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>";
                }
            } else {
                $Mensaje .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Solo se permiten imágenes JPG o PNG.
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                </div>";
            }
        }

=======
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'editor')) {
    header('Location: index.php');
    exit;
}
?>
<?php
require 'include/conect.php';

$Mensaje = '';
$row = null;
$Id = isset($_GET['id_poke']) ? (int) $_GET['id_poke'] : 0;

if ($Id > 0) {
    $stmtLoad = $conexion->prepare('SELECT * FROM pokemon WHERE id_poke = ? LIMIT 1');
    $stmtLoad->bind_param('i', $Id);
    $stmtLoad->execute();
    $row = $stmtLoad->get_result()->fetch_assoc();
    $stmtLoad->close();
}

if (isset($_POST['BtnActualizar']) && $row) {
    $identifica = (int) ($_POST['id_poke'] ?? 0);
    if ($identifica !== (int) $row['id_poke']) {
        $Mensaje = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error de validación.</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
        </div>";
    } else {
        $npoke = trim($_POST['npoke'] ?? '');
        $id_tpoke = (int) ($_POST['id_tpoke'] ?? 0);
        $id_sexo = (int) ($_POST['id_sexo'] ?? 0);
        $descripcion = $_POST['descripcion'] ?? '';
        $id_region = (int) ($_POST['id_region'] ?? 0);
        $peso = (float) ($_POST['peso'] ?? 0);
        $altura = (float) ($_POST['altura'] ?? 0);
        $legendario = isset($_POST['legendario']) && $_POST['legendario'] !== '' ? (int) $_POST['legendario'] : null;

        $nuevaImagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $tipo = $_FILES['imagen']['type'];
            if ($tipo === 'image/jpeg' || $tipo === 'image/png' || $tipo === 'image/jpg') {
                $nombreImagen = basename($_FILES['imagen']['name']);
                $ruta = 'assets/img/' . $nombreImagen;
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta)) {
                    $nuevaImagen = $nombreImagen;
                } else {
                    $Mensaje .= "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        No se pudo guardar la imagen. Se mantuvo la anterior.
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                    </div>";
                }
            } else {
                $Mensaje .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Solo se permiten imágenes JPG o PNG.
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                </div>";
            }
        }

>>>>>>> 57d539dc7093b1a37f471e6124960133556029c7
        if ($npoke === '') {
            $Mensaje .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>El nombre es obligatorio</strong>.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        } elseif ($legendario === null || ($legendario !== 0 && $legendario !== 1)) {
            $Mensaje .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Indica si el Pokémon es legendario.
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
        } else {
            if ($nuevaImagen !== null) {
                $upd = $conexion->prepare(
                    'UPDATE pokemon SET npoke=?, id_tpoke=?, id_sexo=?, descripcion=?, id_region=?, peso=?, altura=?, legendario=?, imagen=? WHERE id_poke=?'
                );
                $upd->bind_param(
                    'siisiddisi',
                    $npoke,
                    $id_tpoke,
                    $id_sexo,
                    $descripcion,
                    $id_region,
                    $peso,
                    $altura,
                    $legendario,
                    $nuevaImagen,
                    $identifica
                );
            } else {
                $upd = $conexion->prepare(
                    'UPDATE pokemon SET npoke=?, id_tpoke=?, id_sexo=?, descripcion=?, id_region=?, peso=?, altura=?, legendario=? WHERE id_poke=?'
                );
                $upd->bind_param(
                    'siisiddii',
                    $npoke,
                    $id_tpoke,
                    $id_sexo,
                    $descripcion,
                    $id_region,
                    $peso,
                    $altura,
                    $legendario,
                    $identifica
                );
            }

            if ($upd->execute()) {
                $upd->close();
                header('Location: control.php?actualizacion=exitosa');
                exit;
            }
            $Mensaje .= "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error al actualizar.</strong> Inténtalo más tarde.
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>";
            $upd->close();
        }
    }

    if ($identifica === $Id && $Id > 0) {
        $stmtLoad = $conexion->prepare('SELECT * FROM pokemon WHERE id_poke = ? LIMIT 1');
        $stmtLoad->bind_param('i', $Id);
        $stmtLoad->execute();
        $row = $stmtLoad->get_result()->fetch_assoc();
        $stmtLoad->close();
    }
}

$tipos = $conexion->query('SELECT id_tpoke, ntpoke FROM tipopoke ORDER BY ntpoke');
$sexos = $conexion->query('SELECT id_sexo, nsexo FROM sexo ORDER BY nsexo');
$regiones = $conexion->query('SELECT id_region, nregion FROM region ORDER BY nregion');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ffecd2,rgb(245, 195, 179));
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

        <?php if (!$row): ?>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-warning">No se encontró el Pokémon o el ID no es válido.</div>
                    <a href="control.php" class="btn btn-secondary">Volver al control</a>
                </div>
            </div>
        <?php else: ?>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4">

                        <div class="text-center">
                            <h2 class="mt-2">Editar Pokémon</h2>
                            <p>Modifica los datos del Pokémon</p>
                        </div>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id_poke=' . (int) $row['id_poke']); ?>"
                            method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id_poke" value="<?php echo (int) $row['id_poke']; ?>">

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Nombre del Pokémon</label>
                                    <input type="text" name="npoke" class="form-control"
                                        value="<?php echo htmlspecialchars($row['npoke']); ?>" placeholder="Nombre del Pokémon" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Tipo</label>
                                    <select name="id_tpoke" class="form-select" required>
                                        <option value="">Tipo de Pokémon</option>
                                        <?php
                                        if ($tipos) {
                                            while ($t = $tipos->fetch_assoc()): ?>
                                                <option value="<?php echo (int) $t['id_tpoke']; ?>"
                                                    <?php echo (int) $row['id_tpoke'] === (int) $t['id_tpoke'] ? ' selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($t['ntpoke']); ?>
                                                </option>
                                            <?php endwhile;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label">Sexo</label>
                                    <select name="id_sexo" class="form-select" required>
                                        <option value="">Sexo</option>
                                        <?php
                                        if ($sexos) {
                                            while ($s = $sexos->fetch_assoc()): ?>
                                                <option value="<?php echo (int) $s['id_sexo']; ?>"
                                                    <?php echo (int) $row['id_sexo'] === (int) $s['id_sexo'] ? ' selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($s['nsexo']); ?>
                                                </option>
                                            <?php endwhile;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="4"
                                        placeholder="Descripción" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Región</label>
                                    <select name="id_region" class="form-select" required>
                                        <option value="">Región</option>
                                        <?php
                                        if ($regiones) {
                                            while ($r = $regiones->fetch_assoc()): ?>
                                                <option value="<?php echo (int) $r['id_region']; ?>"
                                                    <?php echo (int) $row['id_region'] === (int) $r['id_region'] ? ' selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($r['nregion']); ?>
                                                </option>
                                            <?php endwhile;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Peso (kg)</label>
                                    <input type="number" name="peso" class="form-control"
                                        value="<?php echo htmlspecialchars($row['peso']); ?>"
                                        placeholder="Peso (kg)" step="0.01" min="0" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Altura (m)</label>
                                    <input type="number" name="altura" class="form-control"
                                        value="<?php echo htmlspecialchars($row['altura']); ?>"
                                        placeholder="Altura (m)" step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">¿Es legendario?</label>
                                    <select name="legendario" class="form-select" required>
                                        <option value="">¿Es legendario?</option>
                                        <option value="1" <?php echo (int) $row['legendario'] === 1 ? 'selected' : ''; ?>>Sí</option>
                                        <option value="0" <?php echo (int) $row['legendario'] === 0 ? 'selected' : ''; ?>>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Imagen (opcional)</label>
                                    <?php if (!empty($row['imagen'])): ?>
                                        <div class="mb-2 text-center">
                                            <img src="assets/img/<?php echo htmlspecialchars($row['imagen']); ?>"
                                                alt="Imagen actual" class="img-fluid rounded" style="max-height: 160px;">
                                            <p class="small text-muted mb-0 mt-1">Imagen actual: <?php echo htmlspecialchars($row['imagen']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="imagen" class="form-control" accept="image/jpeg,image/png">
                                    <div class="form-text">Deja vacío para conservar la imagen actual.</div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <input type="submit" value="Actualizar" name="BtnActualizar" class="btn btn-warning w-100">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
