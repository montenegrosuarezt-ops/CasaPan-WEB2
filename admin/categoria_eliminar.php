<?php

session_start();

if (
    !isset($_SESSION["id_usuario"])
    || $_SESSION["id_rol"] != 1
)
{
    header("Location: ../auth/login.php");
    exit();
}

include("../config/conexion.php");

if (!isset($_GET["id"]))
{
    header("Location: categorias.php");
    exit();
}

$id = (int)$_GET["id"];

/*
    Verificar si la categoría tiene productos asociados.
*/

$sql = "
SELECT COUNT(*) AS total
FROM productos
WHERE id_categoria = ?
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

$resultado =
mysqli_stmt_get_result($stmt);

$fila =
mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if ($fila["total"] > 0)
{
    echo "
    <script>
        alert('No se puede eliminar la categoría porque tiene productos asociados.');
        window.location='categorias.php';
    </script>
    ";
    exit();
}

/*
    Eliminar categoría
*/

$sql = "
DELETE FROM categorias
WHERE id_categoria = ?
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

header("Location: categorias.php");
exit();

?>