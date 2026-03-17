<?php
include 'include/conect.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>POKEDEX</title>
<link rel="stylesheet" href="assets/css/estilo.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

<!-- MENÚ -->
<nav class="menu">
<ul>
<li><a href="#">Inicio</a></li>
<li>
<a href="prueba.php">Conoce más</a>
<ul>
<li>
<a href="#">Tipos</a>
<ul>
<li><a href="#">Agua</a></li>
<li><a href="#">Planta</a></li>
<li><a href="#">Fuego</a></li>
</ul>
</li>
</ul>
</li>
</ul>
</nav>

<!-- CONTENIDO CENTRAL -->
<div class="contenido">

<h1>Bienvenidos al mundo POKÉMON</h1>
<p>Podras conocer mas sobre de tus personajes favoritos</p>
<a href="todos.php" class="btn btn-sm btn-primary">COMIENZA</a>
<?php
echo $alerta;
?>
</div>


</body>
</html>



