<?php
session_start();

if (!isset($_SESSION["id_usuario"]) || $_SESSION["id_rol"] != 2)
{
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Gerente</title>

<link rel="stylesheet" href="../css/styles.css">
</head>

<body>

<main style="max-width:1000px;margin:auto;padding:40px;">

<h1>
Panel Gerente
</h1>

<p>
Bienvenido <?php echo $_SESSION["nombre"]; ?>
</p>

<div class="cards">

<a href="../admin/usuarios.php" class="card">
<h3>Gestionar Usuarios</h3>
</a>

<a href="pedidos.php" class="card">
<h3>Gestionar Pedidos</h3>
</a>

<a href="../index.php" class="card">
<h3>Ir al Sitio Web</h3>
</a>

</div>

<br>

<a href="../auth/logout.php" class="btn">
Cerrar Sesión
</a>

</main>

</body>
</html>