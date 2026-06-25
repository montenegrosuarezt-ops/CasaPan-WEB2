<?php
session_start();
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Contacto · CASAPAN</title>

<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<header class="site-header">

<nav class="navbar">

<a href="index.php" class="brand">
<img src="assets/logo-casapan.jpg" alt="CASAPAN logo">
<span>CASAPAN</span>
</a>

<button class="burger">☰</button>

<ul class="nav-links">
<li><a href="index.php">Inicio</a></li>
<li><a href="about.php">Sobre nosotros</a></li>
<li><a href="productos.php">Productos</a></li>
<li><a href="catalogo.php">Catálogo</a></li>
<li><a href="contacto.php" class="active">Contacto</a></li>
</ul>

<div class="nav-actions">

<?php

if(isset($_SESSION["id_usuario"]))
{
    echo "<span>Hola, ".$_SESSION["nombre"]."</span>";

    if($_SESSION["id_rol"] == 1)
    {
        echo '<a href="admin/dashboard.php" class="btn">Panel Admin</a>';
    }

    if($_SESSION["id_rol"] == 2)
    {
        echo '<a href="gerente/dashboard.php" class="btn">Panel Gerente</a>';
    }

    if($_SESSION["id_rol"] == 3)
    {
        echo '<a href="cliente/dashboard.php" class="btn">Mi Cuenta</a>';
    }

    echo '<a href="auth/logout.php" class="btn">Salir</a>';
}
else
{
    echo '<a href="auth/login.php" class="btn">Login</a>';
}
?>

<button id="dark-mode-toggle" class="btn-icon">🔆</button>

<a
href="carrito/carrito.php"
class="btn btn-primary">

Carrito

</a>

</div>

</nav>

</header>

<main>

<h1>Contacto y pedidos</h1>

<form id="order-form">

<input
type="text"
name="name"
id="name"
class="input"
placeholder="Nombre completo"
required>

<input
type="text"
name="phone"
id="phone"
class="input"
placeholder="Teléfono"
required>

<input
type="text"
name="table"
class="input"
placeholder="Mesa (si es pedido desde el local)">

<input
type="text"
name="address"
class="input"
placeholder="Dirección (si es delivery)">

<textarea
name="notes"
class="input"
placeholder="Algo que quieras añadir?"></textarea>

<button class="btn btn-primary">
Enviar pedido
</button>

</form>

<h2>Información</h2>

<p>Teléfono: 73128301</p>

<p>Horario: 7:30 – 12:00 y 16:00 – 22:00</p>

<p>
Instagram:
<a href="https://instagram.com/casapanpanaderia" target="_blank">
@casapanpanaderia
</a>
</p>

<p>
Dirección:
c/Félix Sattori entre c/Cochabamba y av/Cipriano,
Barace, Trinidad
</p>

</main>



<script src="js/script.js"></script>

</body>
</html>