<?php

session_start();

if (!isset($_SESSION["id_usuario"]))
{
    header("Location: ../auth/login.php");
    exit();
}

if (!isset($_SESSION["carrito"]))
{
    $_SESSION["carrito"] = [];
}

$idProducto = intval($_GET["id"]);

if (isset($_SESSION["carrito"][$idProducto]))
{
    $_SESSION["carrito"][$idProducto]++;
}
else
{
    $_SESSION["carrito"][$idProducto] = 1;
}

header("Location: ../catalogo.php");
exit();

?>