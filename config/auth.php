<?php

if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

function verificarSesion()
{
    if (!isset($_SESSION["id_usuario"]))
    {
        header("Location: ../auth/login.php");
        exit();
    }
}

function verificarRol($rol)
{
    verificarSesion();

    if ($_SESSION["id_rol"] != $rol)
    {
        header("Location: ../auth/login.php");
        exit();
    }
}

?>