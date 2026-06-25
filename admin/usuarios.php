<?php

session_start();

if(
    !isset($_SESSION["id_usuario"])
    ||
    (
        $_SESSION["id_rol"] != 1
        &&
        $_SESSION["id_rol"] != 2
    )
)
{
    header("Location: ../auth/login.php");
    exit();
}

include("../config/conexion.php");

$sql = "
SELECT
u.id_usuario,
u.nombre,
u.correo,
r.nombre_rol
FROM usuarios u
INNER JOIN roles r
ON u.id_rol = r.id_rol
ORDER BY u.nombre
";

$resultado = mysqli_query(
$conexion,
$sql
);

$rutaVolver = "dashboard.php";

if($_SESSION["id_rol"] == 2)
{
    $rutaVolver = "../gerente/dashboard.php";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Gestión Usuarios</title>

<link
rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main style="max-width:1200px;margin:auto;padding:40px;">

<h1>
Gestión de Usuarios
</h1>

<br>

<table border="1" cellpadding="10" width="100%">

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Correo</th>
<th>Rol</th>
<th>Acciones</th>

</tr>

<?php
while(
$fila =
mysqli_fetch_assoc($resultado)
)
{
?>

<tr>

<td>
<?php echo $fila["id_usuario"]; ?>
</td>

<td>
<?php echo $fila["nombre"]; ?>
</td>

<td>
<?php echo $fila["correo"]; ?>
</td>

<td>
<?php echo $fila["nombre_rol"]; ?>
</td>

<td>

<a
href="usuario-editar.php?id=<?php echo $fila["id_usuario"]; ?>"
class="btn">

Editar

</a>

<?php
if($fila["id_usuario"] != $_SESSION["id_usuario"])
{
?>

<a
href="usuario-eliminar.php?id=<?php echo $fila["id_usuario"]; ?>"
class="btn"
onclick="return confirm('¿Eliminar usuario?')">

Eliminar

</a>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</table>

<br>

<a
href="<?php echo $rutaVolver; ?>"
class="btn">

Volver

</a>

</main>

</body>
</html>