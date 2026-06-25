<?php

session_start();

include("config/conexion.php");

$sql = "
SELECT *
FROM categorias
ORDER BY nombre_categoria
";

$resultado =
mysqli_query(
    $conexion,
    $sql
);

?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Productos · CASAPAN</title>

<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header class="site-header">

<nav class="navbar">

<a href="index.php" class="brand">
<img src="assets/logo-casapan.jpg" alt="CASAPAN logo">
<span>CASAPAN</span>
</a>

<button class="burger">☰</button>

<ul class="nav-links">
<li><a href="index.php">Inicio</a></li>
<li><a href="about.php">Sobre nosotros</a></li>
<li><a href="productos.php" class="active">Productos</a></li>
<li><a href="catalogo.php">Catálogo</a></li>
<li><a href="contacto.php">Contacto</a></li>
</ul>

<div class="nav-actions">

<?php

if(isset($_SESSION["id_usuario"]))
{
    echo "<span>Hola, ".$_SESSION["nombre"]."</span>";

    if($_SESSION["id_rol"] == 1)
    {
        echo '<a href="admin/dashboard.php" class="btn">Panel Admin</a>';
    }

    if($_SESSION["id_rol"] == 2)
    {
        echo '<a href="gerente/dashboard.php" class="btn">Panel Gerente</a>';
    }

    if($_SESSION["id_rol"] == 3)
    {
        echo '<a href="cliente/dashboard.php" class="btn">Mi Cuenta</a>';
    }

    echo '<a href="auth/logout.php" class="btn">Salir</a>';
}
else
{
    echo '<a href="auth/login.php" class="btn">Login</a>';
}
?>

<button id="dark-mode-toggle-2" class="btn-icon">🔆</button>

<a
href="carrito/carrito.php"
class="btn btn-primary">

Carrito

</a>

</div>

</nav>

</header>

<main>

<h1>Categorías de productos</h1>

<p style="color:var(--muted)">
Elige una categoría para ver la lista completa.
</p>

<div class="cards">

<?php

while(
$categoria =
mysqli_fetch_assoc($resultado)
)
{
?>

<a
href="productos-lista.php?id=<?php echo $categoria["id_categoria"]; ?>"
class="category-card">

<img
src="assets/categorias/<?php echo $categoria["imagen"]; ?>"
alt="<?php echo $categoria["nombre_categoria"]; ?>">

<h3>
<?php echo $categoria["nombre_categoria"]; ?>
</h3>

<p>
Ver productos
</p>

</a>

<?php
}
?>

</div>

</main>


<script src="js/script.js"></script>

</body>
</html>