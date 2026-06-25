<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1)
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = (int)$_POST["id_producto"];
    $nombre = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio = (float)$_POST["precio"];
    $idCategoria = (int)$_POST["id_categoria"];

    if (
        isset($_FILES["imagen"]) &&
        $_FILES["imagen"]["error"] == 0 &&
        $_FILES["imagen"]["name"] != ""
    )
    {
        $imagen =
            time() . "_" .
            basename($_FILES["imagen"]["name"]);

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../assets/productos/" . $imagen
        );

        $sql = "
        UPDATE productos
        SET
            nombre = ?,
            descripcion = ?,
            precio = ?,
            imagen = ?,
            id_categoria = ?
        WHERE id_producto = ?
        ";

        $stmt = mysqli_prepare(
            $conexion,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssdsii",
            $nombre,
            $descripcion,
            $precio,
            $imagen,
            $idCategoria,
            $id
        );
    }
    else
    {
        $sql = "
        UPDATE productos
        SET
            nombre = ?,
            descripcion = ?,
            precio = ?,
            id_categoria = ?
        WHERE id_producto = ?
        ";

        $stmt = mysqli_prepare(
            $conexion,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssdii",
            $nombre,
            $descripcion,
            $precio,
            $idCategoria,
            $id
        );
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
header("Location: productos.php");
exit();
?>