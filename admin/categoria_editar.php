<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1)
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../config/conexion.php");

$id = $_GET["id"];

$sql = "SELECT *
        FROM categorias
        WHERE id_categoria = ?";

$stmt = mysqli_prepare($conexion, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$resultado =
mysqli_stmt_get_result($stmt);

$categoria =
mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$categoria)
{
    header("Location: categorias.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Categoría</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<main style="max-width:700px;margin:auto">

<h1>Editar Categoría</h1>

<form
method="POST"
action="categoria_actualizar.php"
enctype="multipart/form-data">

<input
type="hidden"
name="id_categoria"
value="<?php echo $categoria["id_categoria"]; ?>">

<input
type="text"
name="nombre_categoria"
class="input"
value="<?php echo $categoria["nombre_categoria"]; ?>"
required>

<input
type="file"
name="imagen"
class="input">

<button
type="submit"
class="btn btn-primary">

Actualizar

</button>

<a
href="categorias.php"
class="btn">

Cancelar

</a>

</form>

</main>

</body>
</html>