<?php

function verificarSesion()
{
    if (!isset($_SESSION["id_usuario"]))
    {
        header("Location: ../auth/login.php");
        exit();
    }
}

function verificarRol($rolPermitido)
{
    verificarSesion();

    if ($_SESSION["id_rol"] != $rolPermitido)
    {
        header("Location: ../auth/login.php");
        exit();
    }
}

function obtenerProductoPorId($conexion, $idProducto)
{
    $sql = "SELECT *
            FROM productos
            WHERE id_producto = ?";

    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $idProducto
    );

    mysqli_stmt_execute($stmt);

    $resultado =
    mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($resultado);
}

function obtenerCantidadCarrito()
{
    if (!isset($_SESSION["carrito"]))
    {
        return 0;
    }

    $cantidad = 0;

    foreach ($_SESSION["carrito"] as $item)
    {
        $cantidad += $item;
    }

    return $cantidad;
}

function calcularTotalCarrito($conexion)
{
    $total = 0;

    if (!isset($_SESSION["carrito"]))
    {
        return $total;
    }

    foreach ($_SESSION["carrito"] as $idProducto => $cantidad)
    {
        $producto =
        obtenerProductoPorId(
            $conexion,
            $idProducto
        );

        if ($producto)
        {
            $total +=
            $producto["precio"] * $cantidad;
        }
    }

    return $total;
}

function redirigirSegunRol($idRol)
{
    switch ($idRol)
    {
        case 1:
            header("Location: ../admin/dashboard.php");
            break;

        case 2:
            header("Location: ../gerente/dashboard.php");
            break;

        case 3:
            header("Location: ../cliente/dashboard.php");
            break;

        default:
            header("Location: login.php");
            break;
    }

    exit();
}

?>