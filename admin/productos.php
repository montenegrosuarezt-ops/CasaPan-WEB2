<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1)
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../config/conexion.php");

$sqlProductos = "
SELECT p.*,
       c.nombre_categoria
FROM productos p
INNER JOIN categorias c
ON p.id_categoria = c.id_categoria
ORDER BY p.nombre
";

$productos = mysqli_query(
    $conexion,
    $sqlProductos
);

$sqlCategorias = "
SELECT *
FROM categorias
ORDER BY nombre_categoria
";

$categorias = mysqli_query(
    $conexion,
    $sqlCategorias
);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Productos</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<main style="max-width:1200px;margin:auto">

<h1>Gestión de Productos</h1>

<p>

<a href="dashboard.php" class="btn">
Volver
</a>

</p>

<hr>

<h2>Nuevo Producto</h2>

<form
method="POST"
action="producto_guardar.php"
enctype="multipart/form-data">

<input
type="text"
name="nombre"
class="input"
placeholder="Nombre"
required>

<textarea
name="descripcion"
class="input"
placeholder="Descripción">
</textarea>

<input
type="number"
step="0.01"
name="precio"
class="input"
placeholder="Precio"
required>

<input
type="file"
name="imagen"
class="input"
accept="image/*">

<select
name="id_categoria"
class="input"
required>

<option value="">
Seleccione categoría
</option>

<?php
while($cat = mysqli_fetch_assoc($categorias))
{
?>
<option value="<?php echo $cat["id_categoria"]; ?>">
<?php echo $cat["nombre_categoria"]; ?>
</option>
<?php
}
?>

</select>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

<hr>

<h2>Productos Registrados</h2>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Categoría</th>
<th>Precio</th>
<th>Imagen</th>
<th>Estado</th>
<th>Acciones</th>

</tr>

<?php
while($fila = mysqli_fetch_assoc($productos))
{
?>

<tr>

<td>
<?php echo $fila["id_producto"]; ?>
</td>

<td>
<?php echo $fila["nombre"]; ?>
</td>

<td>
<?php echo $fila["nombre_categoria"]; ?>
</td>

<td>
Bs. <?php echo $fila["precio"]; ?>
</td>

<td>

<?php
if($fila["imagen"] != "")
{
?>

<img
src="../assets/productos/<?php echo $fila["imagen"]; ?>"
width="80">

<?php
}
?>

</td>

<td>

<?php
echo $fila["estado"]
? "Activo"
: "Inactivo";
?>

</td>

<td>

<a
href="producto_editar.php?id=<?php echo $fila["id_producto"]; ?>">

Editar

</a>

|

<a
href="producto_estado.php?id=<?php echo $fila["id_producto"]; ?>">

<?php
echo $fila["estado"]
? "Desactivar"
: "Activar";
?>

</a>

|

<a
href="producto_eliminar.php?id=<?php echo $fila["id_producto"]; ?>"
onclick="return confirm('¿Eliminar producto?')">

Eliminar

</a>

</td>

</tr>

<?php
}
?>

</table>

</main>

</body>
</html>