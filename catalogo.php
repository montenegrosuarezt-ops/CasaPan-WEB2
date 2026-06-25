<?php
session_start();

if (!isset($_SESSION["id_usuario"]))
{
    header("Location: auth/login.php");
    exit();
}

include("config/conexion.php");
require_once("includes/funciones.php");

if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

$sql = "
SELECT
    p.*,
    c.nombre_categoria
FROM productos p
INNER JOIN categorias c
ON p.id_categoria = c.id_categoria
WHERE p.estado = 1
ORDER BY c.nombre_categoria, p.nombre
";

$resultado = mysqli_query(
    $conexion,
    $sql
);
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1">

<title>Catálogo - CASAPAN</title>

<link
rel="stylesheet"
href="css/styles.css">

<style>

.catalogo-grid
{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:20px;
    margin-top:30px;
}

.card img
{
    width:100%;
    height:200px;
    object-fit:cover;
    border-radius:10px;
}

.categoria
{
    color:var(--primary);
    font-weight:bold;
    margin-top:10px;
}

.card-actions
{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:15px;
}

.card-actions div
{
    display:flex;
    gap:10px;
}

.modal
{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.8);
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal-contenido
{
    background:#1b1b1b;
    padding:20px;
    border-radius:10px;
    width:500px;
    max-width:90%;
    text-align:center;
}

.modal-contenido img
{
    width:100%;
    max-height:350px;
    object-fit:cover;
    border-radius:10px;
}

#cerrarModal
{
    float:right;
    cursor:pointer;
    font-size:28px;
    font-weight:bold;
}

</style>

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
<li><a class="active" href="catalogo.php">Catálogo</a></li>
<li><a href="contacto.php">Contacto</a></li>
</ul>

<div class="nav-actions">

<?php
if(isset($_SESSION["id_usuario"]))
{
echo "<span>Hola, ".$_SESSION["nombre"]."</span>";
echo '<a href="auth/logout.php" class="btn">Salir</a>';
}
else
{
echo '<a href="auth/login.php" class="btn">Login</a>';
}
?>

<button id="dark-mode-toggle-3" class="btn-icon">🔆</button>

&nbsp;&nbsp;

<a
href="carrito/carrito.php"
class="btn btn-primary">

Carrito
(
<?php echo obtenerCantidadCarrito(); ?>
)

</a>


</div>

</nav>

</header>

<main>

<h1>
Catálogo de Productos
</h1>

<input
type="text"
id="buscar"
placeholder="Buscar producto..."
class="input">

<p>
Productos disponibles actualmente en CASAPAN.
</p>

<div class="catalogo-grid">

<?php
while (
$fila =
mysqli_fetch_assoc($resultado)
)
{
?>

<div class="card">

<img
src="assets/productos/<?php echo $fila["imagen"]; ?>"
alt="<?php echo $fila["nombre"]; ?>">

<h3>
<?php echo $fila["nombre"]; ?>
</h3>

<p>
<?php echo $fila["descripcion"]; ?>
</p>

<p class="categoria">
<?php echo $fila["nombre_categoria"]; ?>
</p>

<div class="card-actions">

<strong>

Bs.
<?php echo number_format($fila["precio"],2); ?>

</strong>

<div>

<button
class="btn btn-ver"
data-imagen="assets/<?php echo $fila["imagen"]; ?>"
data-nombre="<?php echo $fila["nombre"]; ?>"
data-descripcion="<?php echo $fila["descripcion"]; ?>"
data-precio="<?php echo $fila["precio"]; ?>">

Ver

</button>

<a
href="carrito/agregar_carrito.php?id=<?php echo $fila["id_producto"]; ?>"
class="btn btn-primary">

Agregar

</a>

</div>

</div>

</div>

<?php
}
?>

</div>

</main>

<div id="modalProducto" class="modal">

<div class="modal-contenido">

<span id="cerrarModal">
&times;
</span>

<img
id="modalImagen"
src=""
alt="Producto">

<h2 id="modalNombre"></h2>

<p id="modalDescripcion"></p>

<h3 id="modalPrecio"></h3>

</div>

</div>

<script>

const buscador =
document.getElementById("buscar");

buscador.addEventListener(
"keyup",
function()
{
    let texto =
    this.value.toLowerCase();

    let tarjetas =
    document.querySelectorAll(".card");

    tarjetas.forEach(function(card)
    {
        let nombre =
        card.querySelector("h3")
        .innerText
        .toLowerCase();

        if(nombre.includes(texto))
        {
            card.style.display = "block";
        }
        else
        {
            card.style.display = "none";
        }
    });
}
);

const modal =
document.getElementById("modalProducto");

const imagen =
document.getElementById("modalImagen");

const nombre =
document.getElementById("modalNombre");

const descripcion =
document.getElementById("modalDescripcion");

const precio =
document.getElementById("modalPrecio");

document
.querySelectorAll(".btn-ver")
.forEach(function(boton)
{
    boton.addEventListener(
    "click",
    function()
    {
        imagen.src =
        this.dataset.imagen;

        nombre.innerText =
        this.dataset.nombre;

        descripcion.innerText =
        this.dataset.descripcion;

        precio.innerText =
        "Bs. " + this.dataset.precio;

        modal.style.display =
        "flex";
    });
});

document
.getElementById("cerrarModal")
.addEventListener(
"click",
function()
{
    modal.style.display =
    "none";
}
);

window.addEventListener(
"click",
function(e)
{
    if(e.target == modal)
    {
        modal.style.display =
        "none";
    }
}
);

</script>

</body>
</html>