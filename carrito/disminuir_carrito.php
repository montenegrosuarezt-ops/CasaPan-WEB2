<?php

session_start();

if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

$idProducto = intval($_GET["id"]);

if (isset($_SESSION["carrito"][$idProducto]))
{
    $_SESSION["carrito"][$idProducto]--;

    if ($_SESSION["carrito"][$idProducto] <= 0)
    {
        unset($_SESSION["carrito"][$idProducto]);
    }
}

header("Location: carrito.php");
exit();

?>