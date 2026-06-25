<?php
session_start();

include("config/conexion.php");

$idCategoria =
isset($_GET["id"])
? (int)$_GET["id"]
: 0;

$nombreCategoria = "";

$productos = [];

if ($idCategoria > 0)
{
    $sqlCategoria = "
    SELECT nombre_categoria
    FROM categorias
    WHERE id_categoria = ?
    ";

    $stmtCategoria =
    mysqli_prepare(
        $conexion,
        $sqlCategoria
    );

    mysqli_stmt_bind_param(
        $stmtCategoria,
        "i",
        $idCategoria
    );

    mysqli_stmt_execute(
        $stmtCategoria
    );

    $resultadoCategoria =
    mysqli_stmt_get_result(
        $stmtCategoria
    );

    if (
        $categoria =
        mysqli_fetch_assoc(
            $resultadoCategoria
        )
    )
    {
        $nombreCategoria =
        $categoria["nombre_categoria"];
    }

    mysqli_stmt_close(
        $stmtCategoria
    );

    $sql = "
    SELECT *
    FROM productos
    WHERE id_categoria = ?
    AND estado = 1
    ORDER BY nombre
    ";

    $stmt =
    mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $idCategoria
    );

    mysqli_stmt_execute(
        $stmt
    );

    $resultado =
    mysqli_stmt_get_result(
        $stmt
    );

    while (
        $fila =
        mysqli_fetch_assoc(
            $resultado
        )
    )
    {
        $productos[] = $fila;
    }

    mysqli_stmt_close(
        $stmt
    );
}
?>

<!doctype html>

<html lang="es">

<head>

<meta charset="utf-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>Productos · CASAPAN</title>

<link
rel="stylesheet"
href="css/styles.css">

</head>

<body>

<header class="site-header">

<nav class="navbar">

<a href="index.php" class="brand">

<img
src="assets/logo-casapan.jpg"
alt="CASAPAN">

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

<button id="dark-mode-toggle-2" class="btn-icon">
🔆
</button>

<a
href="carrito/carrito.php"
class="btn btn-primary">
Carrito </a>

</div>

</nav>

</header>

<main>

<h1>
<?php echo $nombreCategoria; ?>
</h1>

<p style="color:var(--muted)">
Productos disponibles.
</p>

<?php if(count($productos)==0){ ?>

<p>No hay productos disponibles.</p>

<?php } else { ?>

<div class="cards">

<?php foreach($productos as $producto){ ?>

<div class="card">

<img
src="assets/productos/<?php echo $producto["imagen"]; ?>"
alt="<?php echo $producto["nombre"]; ?>">

<h3>
<?php echo $producto["nombre"]; ?>
</h3>

<p>
<?php echo $producto["descripcion"]; ?>
</p>

<p class="price">
Bs. <?php echo number_format($producto["precio"],2); ?>
</p>

<a
href="carrito/agregar_carrito.php?id=<?php echo $producto["id_producto"]; ?>"
class="btn btn-primary">

Agregar al carrito

</a>

</div>

<?php } ?>

</div>

<?php } ?>

</main>

<script src="js/script.js"></script>

</body>
</html>
