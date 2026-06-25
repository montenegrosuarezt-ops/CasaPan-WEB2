<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1)
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../config/conexion.php");

$id = $_GET["id"];

$sql = "
DELETE FROM productos
WHERE id_producto = ?
";

$stmt = mysqli_prepare(
    $conexion,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header("Location: productos.php");
exit();
?>