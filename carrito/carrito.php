<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

verificarSesion();

if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

$total = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Carrito - CASAPAN
</title>

<link
rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<header class="site-header">

<nav class="navbar">

<a href="../catalogo.php" class="brand">
CASAPAN
</a>

<div>

<a
href="../catalogo.php"
class="btn">

Seguir comprando

</a>

<a
href="../auth/logout.php"
class="btn">

Cerrar sesión

</a>

</div>

</nav>

</header>

<main>

<h1>
Mi Carrito
</h1>

<?php

if (count($_SESSION["carrito"]) == 0)
{
    echo "<p>El carrito está vacío.</p>";
}
else
{
?>

<table
class="carrito-table"
style="
width:100%;
table-layout:fixed;
border-collapse:collapse;
background:#141518;
">

<tr>

<th>Producto</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Subtotal</th>
<th>Acciones</th>

</tr>

<?php

foreach ($_SESSION["carrito"] as $idProducto => $cantidad)
{
    $producto =
    obtenerProductoPorId(
        $conexion,
        $idProducto
    );

    if (!$producto)
    {
        continue;
    }

    $subtotal =
    $producto["precio"] * $cantidad;

    $total += $subtotal;

?>

<tr>

<td>
<?php echo $producto["nombre"]; ?>
</td>

<td>
Bs. <?php echo number_format($producto["precio"], 2); ?>
</td>

<td>
<?php echo $cantidad; ?>
</td>

<td>
Bs. <?php echo number_format($subtotal, 2); ?>
</td>

<td
style="
width:250px;
text-align:center;
white-space:nowrap;
">
<div
style="
display:flex;
justify-content:center;
align-items:center;
gap:5px;
flex-wrap:nowrap;
">

<a
href="agregar_carrito.php?id=<?php echo $idProducto; ?>"
class="btn"
style="padding:5px 10px;min-width:auto;">
+
</a>

<a
href="disminuir_carrito.php?id=<?php echo $idProducto; ?>"
class="btn"
style="padding:5px 10px;min-width:auto;">
-
</a>

<a
href="eliminar_carrito.php?id=<?php echo $idProducto; ?>"
class="btn"
style="padding:5px 10px;min-width:auto;">
Eliminar
</a>

</div>

</td>

</tr>

<?php
}
?>

</table>

<br>

<h2>

Total:
Bs. <?php echo number_format($total, 2); ?>

</h2>

<br>

<a
href="vaciar_carrito.php"
class="btn">

Vaciar carrito

</a>

&nbsp;

<a
href="confirmar_pedido.php"
class="btn btn-primary">

Confirmar pedido

</a>

<?php
}
?>

</main>

</body>

</html>