<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

verificarRol(1);

$idPedido = intval($_GET["id"]);

$sqlPedido = "SELECT
                p.*,
                u.nombre
              FROM pedidos p
              INNER JOIN usuarios u
              ON p.id_usuario = u.id_usuario
              WHERE p.id_pedido = ?";

$stmt = mysqli_prepare(
    $conexion,
    $sqlPedido
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $idPedido
);

mysqli_stmt_execute($stmt);

$resultado =
mysqli_stmt_get_result($stmt);

$pedido =
mysqli_fetch_assoc($resultado);

$sqlDetalle = "SELECT
                    d.*,
                    p.nombre
               FROM detalle_pedido d
               INNER JOIN productos p
               ON d.id_producto = p.id_producto
               WHERE d.id_pedido = ?";

$stmtDetalle =
mysqli_prepare(
    $conexion,
    $sqlDetalle
);

mysqli_stmt_bind_param(
    $stmtDetalle,
    "i",
    $idPedido
);

mysqli_stmt_execute(
    $stmtDetalle
);

$detalle =
mysqli_stmt_get_result(
    $stmtDetalle
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Detalle Pedido
</title>

<link
rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main>

<h1>

Pedido #<?php echo $pedido["id_pedido"]; ?>

</h1>

<p>

Cliente:
<strong>

<?php echo $pedido["nombre"]; ?>

</strong>

</p>

<p>

Estado:
<strong>

<?php echo $pedido["estado"]; ?>

</strong>

</p>

<p>

Total:
<strong>

Bs.
<?php echo number_format($pedido["total"],2); ?>

</strong>

</p>

<hr>

<h2>
Productos
</h2>

<table
border="1"
cellpadding="10">

<tr>

<th>Producto</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Subtotal</th>

</tr>

<?php

while (
    $fila =
    mysqli_fetch_assoc($detalle)
)
{
?>

<tr>

<td>
<?php echo $fila["nombre"]; ?>
</td>

<td>
<?php echo $fila["cantidad"]; ?>
</td>

<td>
Bs.
<?php echo number_format($fila["precio_unitario"],2); ?>
</td>

<td>
Bs.
<?php echo number_format($fila["subtotal"],2); ?>
</td>

</tr>

<?php
}
?>

</table>

<br>

<a
href="pedidos.php"
class="btn">

Volver

</a>

</main>

</body>

</html>