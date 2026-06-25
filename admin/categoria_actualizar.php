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
    $id = (int)$_POST["id_categoria"];
    $nombre = trim($_POST["nombre_categoria"]);

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
            "../assets/categorias/" . $imagen
        );

        $sql = "
        UPDATE categorias
        SET
            nombre_categoria = ?,
            imagen = ?
        WHERE id_categoria = ?
        ";

        $stmt =
        mysqli_prepare(
            $conexion,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssi",
            $nombre,
            $imagen,
            $id
        );
    }
    else
    {
        $sql = "
        UPDATE categorias
        SET
            nombre_categoria = ?
        WHERE id_categoria = ?
        ";

        $stmt =
        mysqli_prepare(
            $conexion,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $nombre,
            $id
        );
    }

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: categorias.php");
exit();
?>