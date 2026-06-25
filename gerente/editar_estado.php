<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

verificarRol(2);

$idPedido =
intval($_GET["id"]);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $estado =
    $_POST["estado"];

    $sql = "UPDATE pedidos
            SET estado = ?
            WHERE id_pedido = ?";

    $stmt =
    mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "si",
        $estado,
        $idPedido
    );

    mysqli_stmt_execute(
        $stmt
    );

    header("Location: pedidos.php");
    exit();
}

$sqlPedido =
"SELECT *
 FROM pedidos
 WHERE id_pedido = ?";

$stmt =
mysqli_prepare(
    $conexion,
    $sqlPedido
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $idPedido
);

mysqli_stmt_execute(
    $stmt
);

$resultado =
mysqli_stmt_get_result(
    $stmt
);

$pedido =
mysqli_fetch_assoc(
    $resultado
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Cambiar Estado
</title>

<link rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main>

<h1>

Pedido #<?php echo $pedido["id_pedido"]; ?>

</h1>

<form method="POST">

<label>

Estado:

</label>

<br><br>

<select
name="estado"
class="input">

<option
value="Pendiente"
<?php if($pedido["estado"]=="Pendiente") echo "selected"; ?>>

Pendiente

</option>

<option
value="Preparando"
<?php if($pedido["estado"]=="Preparando") echo "selected"; ?>>

Preparando

</option>

<option
value="Entregado"
<?php if($pedido["estado"]=="Entregado") echo "selected"; ?>>

Entregado

</option>

<option
value="Cancelado"
<?php if($pedido["estado"]=="Cancelado") echo "selected"; ?>>

Cancelado

</option>

</select>

<br>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

<br>

<a
href="pedidos.php"
class="btn">

Volver

</a>

</main>

</body>

</html>