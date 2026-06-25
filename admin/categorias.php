<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 1)
{
    header("Location: ../auth/login.php");
    exit();
}

require_once("../config/conexion.php");

$sql = "SELECT * FROM categorias
        ORDER BY nombre_categoria";

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Categorías</title>

<link rel="stylesheet" href="../css/styles.css">

</head>

<body>

<main style="max-width:1000px;margin:auto">

<h1>Gestión de Categorías</h1>

<p>

<a href="dashboard.php" class="btn">
Volver
</a>

</p>

<hr>

<h2>Nueva Categoría</h2>

<form
method="POST"
action="categoria_guardar.php"
enctype="multipart/form-data">

<input
type="text"
name="nombre_categoria"
class="input"
placeholder="Nombre de categoría"
required>

<input
type="file"
name="imagen"
class="input"
required>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

<hr>

<h2>Lista de Categorías</h2>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Acciones</th>

</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

<tr>

<td>
<?php echo $fila["id_categoria"]; ?>
</td>

<td>
<?php echo $fila["nombre_categoria"]; ?>
</td>

<td>

<a
href="categoria_editar.php?id=<?php echo $fila["id_categoria"]; ?>">

Editar

</a>

|

<a
href="categoria_eliminar.php?id=<?php echo $fila["id_categoria"]; ?>"
onclick="return confirm('¿Eliminar categoría?')">

Eliminar

</a>

</td>

</tr>

<?php } ?>

</table>

</main>

</body>
</html>