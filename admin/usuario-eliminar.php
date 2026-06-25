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

$id =
intval($_GET["id"]);

if($id != $_SESSION["id_usuario"])
{
$sql = "
DELETE FROM usuarios
WHERE id_usuario=?
";

$stmt =
mysqli_prepare(
$conexion,
$sql
);

mysqli_stmt_bind_param(
$stmt,
"i",
$id
);

mysqli_stmt_execute($stmt);
}

header("Location: usuarios.php");
exit();