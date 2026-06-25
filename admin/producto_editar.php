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
    $id
);

mysqli_stmt_execute($stmt);

$resultado =
mysqli_stmt_get_result($stmt);

$producto =
mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$producto)
{
    header("Location: productos.php");
    exit();
}

$categorias =
mysqli_query(
    $conexion,
    "SELECT * FROM categorias ORDER BY nombre_categoria"
);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Producto</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<main style="max-width:900px;margin:auto">

<h1>Editar Producto</h1>

<form method="POST"

    action="producto_actualizar.php"

    enctype="multipart/form-data">

    <input type="hidden"

    name="id_producto"

    value="<?php echo $producto["id_producto"]; ?>">

    <input type="text"

    name="nombre"

    class="input"

    value="<?php echo $producto["nombre"]; ?>"

    required>

    <textarea name="descripcion"

    class="input"><?php echo $producto["descripcion"]; ?></textarea>

    <input type="number"

    step="0.01"

    name="precio"

    class="input"

    value="<?php echo $producto["precio"]; ?>"

    required>

    <input type="file"

    name="imagen"

    class="input">

    <select name="id_categoria"

    class="input"

    required>

    <?php while($cat = mysqli_fetch_assoc($categorias)) { ?>

    <option

    value="<?php echo $cat["id_categoria"]; ?>"

    <?php if($cat["id_categoria"] == $producto["id_categoria"]) echo "selected"; ?>>

    <?php echo $cat["nombre_categoria"]; ?>

    </option>

    <?php } ?>

    </select>

    <button type="submit" class="btn btn-primary">

    Actualizar

    </button>

    <a href="productos.php" class="btn">

    Cancelar

    </a>

</form>

</main>

</body>
</html>