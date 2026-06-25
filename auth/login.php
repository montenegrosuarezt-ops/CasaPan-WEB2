<?php

session_start();

require_once("../config/conexion.php");
require_once("../includes/funciones.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    $sql = "SELECT *
            FROM usuarios
            WHERE correo = ?";

    $stmt = mysqli_prepare(
        $conexion,
        $sql
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $correo
    );

    mysqli_stmt_execute($stmt);

    $resultado =
    mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) == 1)
    {
        $usuario =
        mysqli_fetch_assoc($resultado);

        if (
            password_verify(
                $password,
                $usuario["password"]
            )
        )
        {
            $_SESSION["id_usuario"] =
            $usuario["id_usuario"];

            $_SESSION["nombre"] =
            $usuario["nombre"];

            $_SESSION["id_rol"] =
            $usuario["id_rol"];

            redirigirSegunRol(
                $usuario["id_rol"]
            );
        }
        else
        {
            $mensaje =
            "Contraseña incorrecta.";
        }
    }
    else
    {
        $mensaje =
        "Usuario no encontrado.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>
Login - CASAPAN
</title>

<link
rel="stylesheet"
href="../css/styles.css">

</head>

<body>

<main
style="max-width:600px;margin:auto">

<h1>
Iniciar Sesión
</h1>

<?php
if ($mensaje != "")
{
    echo "<p>$mensaje</p>";
}
?>

<form method="POST">

<input
type="email"
name="correo"
class="input"
placeholder="Correo electrónico"
required>

<input
type="password"
name="password"
class="input"
placeholder="Contraseña"
required>

<button
type="submit"
class="btn btn-primary">

Ingresar

</button>

</form>

<br>

<a href="registro.php">
Crear cuenta nueva
</a>

</main>

</body>

</html>