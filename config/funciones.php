<?php

function obtenerProducto($conexion, $idProducto)
{
    $sql = "
    SELECT *
    FROM productos
    WHERE id_producto = ?
    ";

    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );

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

function obtenerProductos($conexion)
{
    $sql = "
    SELECT
        p.*,
        c.nombre_categoria
    FROM productos p
    INNER JOIN categorias c
        ON p.id_categoria = c.id_categoria
    WHERE p.estado = 1
    ORDER BY c.nombre_categoria,
             p.nombre
    ";

    return mysqli_query(
        $conexion,
        $sql
    );
}

function obtenerCategorias($conexion)
{
    $sql = "
    SELECT *
    FROM categorias
    ORDER BY nombre_categoria
    ";

    return mysqli_query(
        $conexion,
        $sql
    );
}

?>