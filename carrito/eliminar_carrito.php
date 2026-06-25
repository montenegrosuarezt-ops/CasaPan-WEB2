<?php

session_start();

$idProducto = intval($_GET["id"]);

if (isset($_SESSION["carrito"][$idProducto]))
{
    unset($_SESSION["carrito"][$idProducto]);
}

header("Location: carrito.php");
exit();

?>