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
    $nombre = trim($_POST["nombre_categoria"]);

    $imagen = "";

    if (
        isset($_FILES["imagen"]) &&
        $_FILES["imagen"]["error"] == 0
    )
    {
        $imagen =
            time() . "_" .
            basename($_FILES["imagen"]["name"]);

        move_uploaded_file(
            $_FILES["imagen"]["tmp_name"],
            "../assets/categorias/" . $imagen
        );
    }

    $sql = "
    INSERT INTO categorias
    (
        nombre_categoria,
        imagen
    )
    VALUES
    (
        ?,
        ?
    )
    ";

    $stmt =
    mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $nombre,
        $imagen
    );

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

header("Location: categorias.php");
exit();
?>