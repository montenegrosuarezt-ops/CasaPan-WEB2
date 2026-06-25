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
    $nombre = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio = $_POST["precio"];
    $idCategoria = $_POST["id_categoria"];

    $imagenNombre = "";

    if (
        isset($_FILES["imagen"]) &&
        $_FILES["imagen"]["error"] == 0
    )
    {
        $extension =
        pathinfo(
            $_FILES["imagen"]["name"],
            PATHINFO_EXTENSION
        );

        $imagenNombre =
        uniqid() . "." . $extension;

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../assets/productos/" . $imagenNombre
        );
    }

    $sql = "
    INSERT INTO productos
    (
        nombre,
        descripcion,
        precio,
        imagen,
        id_categoria
    )
    VALUES
    (
        ?, ?, ?, ?, ?
    )
    ";

    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssdsi",
        $nombre,
        $descripcion,
        $precio,
        $imagenNombre,
        $idCategoria
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: productos.php");
exit();
?>