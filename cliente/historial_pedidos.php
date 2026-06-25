<?php
session_start();

if (!isset($_SESSION["id_usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

include("../config/conexion.php");

$idUsuario = $_SESSION["id_usuario"];

$stmt = $conexion->prepare("
SELECT *
FROM pedidos
WHERE id_usuario = ?
ORDER BY fecha_pedido DESC
");

$stmt->bind_param("i", $idUsuario);
$stmt->execute();

$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Mis Pedidos</title>

<link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<main style="max-width:1000px;margin:auto;padding:40px;">

<h1>
Historial de Pedidos
</h1>

<a href="dashboard.php" class="btn">
Volver
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Fecha</th>
<th>Total</th>
<th>Estado</th>
</tr>

<?php while($pedido = $resultado->fetch_assoc()) { ?>

<tr>

<td>
<?php echo $pedido["id_pedido"]; ?>
</td>

<td>
<?php echo $pedido["fecha_pedido"]; ?>
</td>

<td>
Bs. <?php echo number_format($pedido["total"],2); ?>
</td>

<td>
<?php echo $pedido["estado"]; ?>
</td>

</tr>

<?php } ?>

</table>

</main>

</body>
</html>