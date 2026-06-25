<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 3)
{
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Cliente - CASAPAN</title>

<link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<main style="max-width:900px;margin:auto;padding:40px;">

<div class="card">

<h1>
Bienvenido <?php echo $_SESSION["nombre"]; ?>
</h1>

<p>
Has iniciado sesión correctamente.
</p>

<br>

<a href="../index.php" class="btn btn-primary">
Ir al Sitio Web
</a>

<a href="../cliente/historial_pedidos.php" class="btn">
Mis Pedidos
</a>

<a href="../auth/logout.php" class="btn">
Cerrar Sesión
</a>

</div>

</main>

</body>
</html>