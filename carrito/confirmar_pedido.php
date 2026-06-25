<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

verificarSesion();

if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

if (count($_SESSION["carrito"]) == 0)
{
    header("Location: carrito.php");
    exit();
}

$total =
calcularTotalCarrito($conexion);

$idUsuario =
$_SESSION["id_usuario"];

/*
Pedido temporal:
Mesa 1
Más adelante haremos
formulario para Delivery/Mesa
*/

$tipoPedido = "Mesa";
$numeroMesa = "1";
$direccion = NULL;

$sqlPedido = "INSERT INTO pedidos
(
    id_usuario,
    tipo_pedido,
    numero_mesa,
    direccion,
    total
)
VALUES
(
    ?,
    ?,
    ?,
    ?,
    ?
)";

$stmtPedido =
mysqli_prepare(
    $conexion,
    $sqlPedido
);

mysqli_stmt_bind_param(
    $stmtPedido,
    "isssd",
    $idUsuario,
    $tipoPedido,
    $numeroMesa,
    $direccion,
    $total
);

mysqli_stmt_execute($stmtPedido);

$idPedido =
mysqli_insert_id($conexion);

$sqlDetalle = "INSERT INTO detalle_pedido
(
    id_pedido,
    id_producto,
    cantidad,
    precio_unitario,
    subtotal
)
VALUES
(
    ?,
    ?,
    ?,
    ?,
    ?
)";

$stmtDetalle =
mysqli_prepare(
    $conexion,
    $sqlDetalle
);

foreach
(
    $_SESSION["carrito"]
    as
    $idProducto => $cantidad
)
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

    $precio =
    $producto["precio"];

    $subtotal =
    $precio * $cantidad;

    mysqli_stmt_bind_param(
        $stmtDetalle,
        "iiidd",
        $idPedido,
        $idProducto,
        $cantidad,
        $precio,
        $subtotal
    );

    mysqli_stmt_execute(
        $stmtDetalle
    );
}

$_SESSION["carrito"] = [];

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Pedido Confirmado
</title>

<link
rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main
style="max-width:700px;margin:auto">

<h1>
Pedido Registrado
</h1>

<p>

Su pedido fue registrado correctamente.

</p>

<p>

Número de pedido:

<strong>

#<?php echo $idPedido; ?>

</strong>

</p>

<br>

<a
href="../catalogo.php"
class="btn btn-primary">

Volver al catálogo

</a>

</main>

</body>

</html>