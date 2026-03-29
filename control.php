<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'editor') {
    header('Location: index.php');
    exit;
}
?>
<?php
include 'include/conect.php';
include 'include/querys.php';
if (isset($_GET['actualizacion']) && $_GET['actualizacion'] == "exitosa") {
    echo "<div class='container mt-3'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Actualizacion exitosa.</strong> Se actualizaron los campos correctamente.
            <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
            </div>
          </div>";

    echo "<script>
            if(window.history.replaceState){
                window.history.replaceState(null, null, window.location.pathname);
            }
          </script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff9db;
        }


        .card {
            background-color: #fff3b0;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #f7dc6f;
        }
    </style>
    <title>Control de pokemones</title>
</head>

<body>
    <!-- NAVBAR -->
   <?php include 'vistas/sidebar.php';?>
    <!--contenedor -->
    <div class="container">
        <h1 class="text-center mt-4">Consulta pokemon</h1>
        <div class="row mt-3">
            <!-- Inicia  -->
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Nombre pokemon</th>
                        <th scope="col">Tipo poke</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Región</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Altura</th>
                        <th scope="col">Legendario</th>
                        <th scope="col">Opcion</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    if ($editaree->num_rows == 0) {
                        echo "<tr><td colspan='10'>No hay datos</td></tr>";
                    }
                    ?>
                    <?php while ($row = $editaree->fetch_assoc()) { ?>
                        <tr>

                            <td><?php echo $row['npoke'] ?></td>
                            <td><?php echo $row['id_tpoke'] ?></td>
                            <td><?php echo $row['id_sexo'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['id_region'] ?></td>
                            <td><?php echo $row['peso'] ?></td>
                            <td><?php echo $row['altura'] ?></td>
                            <td><?php echo $row['legendario'] ?></td>
                            <td>
                                <a href="editar.php?id_poke=<?php echo $row['id_poke']; ?>" class="btn btn-warning">
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm"
                                    href="include/Eliminar.php?id=<?php echo $row['id_poke']; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Termina-->
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>