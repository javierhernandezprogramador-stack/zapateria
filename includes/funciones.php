<?php 
define('TEMPLATES_URL', __DIR__ . '/templates/');

//Incluye todos los templates de la vista publica
function incluirTemplates(string $nombre, bool $inicio = false) {
    $urlBase = ROOT_URL;
    require TEMPLATES_URL . '/public/' . $nombre . '.php';
}

//Incluye todo los templates de admin que se requieran
function incluirTemplatesAdmin(string $nombre, bool $accesoAdmin = false,  bool $customProveedor = null, 
bool $customCategoria = null, bool $customVendedor = null, bool $customCliente = null, 
bool $customProducto = null, bool $customCompra = null, bool $customVenta = null, 
bool $customDashboard = null) {
    $urlBase = ROOT_URL; //URL global para acceder a los recursos del sistema
    require TEMPLATES_URL . '/admin/' . $nombre . '.php';
}

function url() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    return $protocol . "://" . $host . $path;
    //return $protocol . "://" . $host . '/zapateria';
}