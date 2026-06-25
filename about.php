<?php
session_start();
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sobre nosotros · CASAPAN</title>

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
<li><a class="active" href="about.php">Sobre nosotros</a></li>
<li><a href="productos.php">Productos</a></li>
<li><a href="catalogo.php">Catálogo</a></li>
<li><a href="contacto.php">Contacto</a></li>
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

<button id="dark-mode-toggle-3" class="btn-icon">🔆</button>

<a
href="carrito/carrito.php"
class="btn btn-primary">

Carrito

</a>

</div>

</nav>

</header>

<main class="container about-page">

<h1>Sobre CASAPAN</h1>

<p>
CASAPAN es una panadería artesanal ubicada en Trinidad, Bolivia.
Nos especializamos en panes artesanales, tortas y repostería fina
con recetas tradicionales y procesos de fermentación natural.
</p>

<h2>Nuestra misión</h2>

<p>
Ofrecer productos de panadería de alta calidad, hechos con
ingredientes seleccionados y técnicas artesanales,
brindando una experiencia cálida y cercana a nuestros clientes.
</p>

<h2>Visión</h2>

<p>
Ser la panadería de referencia en la ciudad por la calidad
de nuestros productos y la facilidad con la que los clientes
puedan acceder a nuestro servicio tanto presencial como online.
</p>

<h2>Equipo</h2>

<p>
Panaderos y reposteros con experiencia,
atención al cliente y un compromiso con la tradición.
</p>

</main>


<script src="js/script.js"></script>

</body>
</html>