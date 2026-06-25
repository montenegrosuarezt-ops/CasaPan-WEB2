<?php
session_start();
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title>CASAPAN · Panadería Artesanal</title>

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
<li><a href="index.php" class="active">Inicio</a></li>
<li><a href="about.php">Sobre nosotros</a></li>
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

    <button id="dark-mode-toggle" class="btn-icon">
    🔆
    </button>

    <a
    href="carrito/carrito.php"
    class="btn btn-primary">

    Carrito

    </a>

    </div>

</nav>

</header>

<main>

<section class="hero">

<h1>CASAPAN · Panadería Artesanal</h1>

<p>
Bienvenido al panel digital del menú y pedidos.
</p>

</section>

<section class="gallery">

<h2>Galería del Local</h2>

<div id="slides" class="gallery-grid">

<img src="assets/ambiente1.jpg" alt="Ambiente 1">
<img src="assets/ambiente2.jpg" alt="Ambiente 2">
<img src="assets/ambiente3.jpg" alt="Ambiente 3">
<img src="assets/ambiente4.jpg" alt="Ambiente 4">
<img src="assets/ambiente5.jpg" alt="Ambiente 5">

</div>

</section>

<section>

<h2>Lo más pedido</h2>

<div id="featured-products"></div>

</section>

<section style="margin-top:60px">

<h2>Horario y contacto</h2>

<p style="color:var(--muted)">
Teléfono: 73128301
</p>

<p style="color:var(--muted)">
Horario: 7:30 - 12:00 y 16:00 - 22:00
</p>

<p style="color:var(--muted)">
Instagram:
<a href="https://instagram.com/casapanpanaderia">
@casapanpanaderia
</a>
</p>

<p style="color:var(--muted)">
Dirección:
c/Félix Sattori entre c/Cochabamba y av/Cipriano,
Barace, Trinidad
</p>

</section>

</main>

<!-- GALERÍA -->

<div id="gallery-modal" class="modal hidden">
<div class="modal-content gallery-modal-inner"></div>
</div>

<!-- PRODUCTO -->

<div id="product-modal" class="modal hidden">

<div class="modal-content" id="product-modal-inner"></div>

<button class="close" id="close-product-modal">
✕
</button>

</div>


<script src="js/script.js"></script>

</body>
</html>