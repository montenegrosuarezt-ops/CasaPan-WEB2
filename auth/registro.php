<?php
session_start();
include("../config/conexion.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $verificar = mysqli_query(
        $conexion,
        "SELECT * FROM usuarios WHERE correo='$correo'"
    );

    if (mysqli_num_rows($verificar) > 0)
    {
        $mensaje = "El correo ya está registrado.";
    }
    else
    {
        $sql = "
        INSERT INTO usuarios
        (
            nombre,
            correo,
            password,
            telefono,
            id_rol
        )
        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            3
        )
        ";

        $stmt =
        mysqli_prepare(
            $conexion,
            $sql
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssss",
            $nombre,
            $correo,
            $password,
            $telefono
        );

        if (mysqli_stmt_execute($stmt))
        {
            $mensaje =
            "Usuario registrado correctamente.";
        }
        else
        {
            $mensaje =
            "Error al registrar usuario.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - CASAPAN</title>

    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<main style="max-width:600px;margin:auto">

    <h1>Registro de Cliente</h1>

    <?php
    if ($mensaje != "")
    {
        echo "<p>$mensaje</p>";
    }
    ?>

    <form method="POST">

        <input
            type="text"
            name="nombre"
            class="input"
            placeholder="Nombre completo"
            required>

        <input
            type="email"
            name="correo"
            class="input"
            placeholder="Correo electrónico"
            required>

        <input
            type="text"
            name="telefono"
            class="input"
            placeholder="Teléfono">

        <input
            type="password"
            name="password"
            class="input"
            placeholder="Contraseña"
            required>

        <button
            type="submit"
            class="btn btn-primary">
            Registrarse
        </button>

    </form>

    <br>

    <a href="login.php">
        ¿Ya tienes cuenta? Inicia sesión
    </a>

</main>

</body>
</html>