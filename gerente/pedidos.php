<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

verificarRol(2);

$sql = "SELECT
            p.id_pedido,
            u.nombre,
            p.tipo_pedido,
            p.total,
            p.estado,
            p.fecha_pedido
        FROM pedidos p
        INNER JOIN usuarios u
        ON p.id_usuario = u.id_usuario
        ORDER BY p.fecha_pedido DESC";

$resultado = mysqli_query(
    $conexion,
    $sql
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Gestión de Pedidos</title>

<link rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main>

<h1>
Gestión de Pedidos
</h1>

<table
border="1"
cellpadding="10"
width="100%">

<tr>

<th>ID</th>
<th>Cliente</th>
<th>Tipo</th>
<th>Total</th>
<th>Estado</th>
<th>Fecha</th>
<th>Acción</th>

</tr>

<?php

while(
    $pedido =
    mysqli_fetch_assoc($resultado)
)
{
?>

<tr>

<td>
<?php echo $pedido["id_pedido"]; ?>
</td>

<td>
<?php echo $pedido["nombre"]; ?>
</td>

<td>
<?php echo $pedido["tipo_pedido"]; ?>
</td>

<td>
Bs. <?php echo number_format($pedido["total"],2); ?>
</td>

<td>
<?php echo $pedido["estado"]; ?>
</td>

<td>
<?php echo $pedido["fecha_pedido"]; ?>
</td>

<td>

<a
href="editar_estado.php?id=<?php echo $pedido["id_pedido"]; ?>"
class="btn">

Cambiar Estado

</a>

</td>

</tr>

<?php
}
?>

</table>

<br>

<a
href="dashboard.php"
class="btn">

Volver

</a>

</main>

</body>

</html>