<?php
session_start();

//Esta condición se cumpre cuando usuario no este registrado y intentes acceder a una pagina de admin
//var_dump($_SERVER['PHP_SELF']);
if (!isset($_SESSION['user']) && !verificarPagina('/' . basename($_SERVER['PHP_SELF']))) {
    header('Location: login.php');
    exit();
    //Esta condición se cumple cuando el usuario esta registrado y esta accediendo desde una pagina admin
} else if (isset($_SESSION['user']) && !verificarPagina($_SERVER['PHP_SELF'])) {
    $accesoAdmin = ($_SESSION['rol'] == 1) ? true : false;
}

require 'funciones.php';
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../route.php'; //manejador de la url base

//funcion que comprueba si la pagina actual se encuentra en el array de direcciones
function verificarPagina($pagina)
{
    $array = [
        "/index.php",
        "/nosotros.php",
        "/contacto.php",
        "/catalogo.php"
    ];

    foreach ($array as $row) {
        if ($row == $pagina) {
            return true;
        }
    }

    return false;
}
