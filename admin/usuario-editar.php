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

$id = intval($_GET["id"]);

if($_SERVER["REQUEST_METHOD"] == "POST")
{
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$id_rol = $_POST["id_rol"];

$sql = "
UPDATE usuarios
SET
nombre=?,
correo=?,
id_rol=?
WHERE id_usuario=?
";

$stmt = mysqli_prepare(
$conexion,
$sql
);

mysqli_stmt_bind_param(
$stmt,
"ssii",
$nombre,
$correo,
$id_rol,
$id
);

mysqli_stmt_execute($stmt);

header("Location: usuarios.php");
exit();
}

$sql = "
SELECT *
FROM usuarios
WHERE id_usuario=$id
";

$usuario =
mysqli_fetch_assoc(
mysqli_query(
$conexion,
$sql
)
);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Editar Usuario</title>

<link rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main style="max-width:700px;margin:auto;padding:40px;">

<h1>
Editar Usuario
</h1>

<form method="POST">

<input
type="text"
name="nombre"
value="<?php echo $usuario["nombre"]; ?>"
class="input"
required>

<input
type="email"
name="correo"
value="<?php echo $usuario["correo"]; ?>"
class="input"
required>

<select
name="id_rol"
class="input">

<option value="1"
<?php if($usuario["id_rol"]==1) echo "selected"; ?>>
Administrador
</option>

<option value="2"
<?php if($usuario["id_rol"]==2) echo "selected"; ?>>
Gerente
</option>

<option value="3"
<?php if($usuario["id_rol"]==3) echo "selected"; ?>>
Cliente
</option>

</select>

<button
type="submit"
class="btn btn-primary">

Guardar

</button>

</form>

</main>

</body>
</html>