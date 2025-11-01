<?php

//Metodo que me permite validar si existe un dato en especifico

function obtenerInformacion($consulta, $conexion): array
{
    $stmt = $conexion->prepare($consulta);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

//validar los datos al guardar un proveedor
function validarProveedor($proveedor, $conexion)
{
    $encriptacion = new Encriptacion();
    $proveedores = obtenerInformacion(LISTADO_PROVEEDORES, $conexion);

    foreach ($proveedores as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if ($email == $proveedor->getEmail()) {
            return ['resultado' => 2];
        }
    }

    foreach ($proveedores as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if ($telefono == $proveedor->getTelefono()) {
            return ['resultado' => 3];
        }
    }

    return null;
}

//validar los datos al intentar modicar un proveedor
function validarProveedorModificar($proveedor, $conexion, $id)
{
    $encriptacion = new Encriptacion();
    $proveedores = obtenerInformacion(LISTADO_PROVEEDORES, $conexion);

    foreach ($proveedores as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if (($email == $proveedor->getEmail()) && ($id != $row['id'])) {
            return ['resultado' => 2];
        }
    }

    foreach ($proveedores as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if (($telefono == $proveedor->getTelefono()) && ($id != $row['id'])) {
            return ['resultado' => 3];
        }
    }

    return null;
}

//validar los datos al guardar un vendedor
function validarVendedor($vendedor, $conexion, $usuario)
{
    $encriptacion = new Encriptacion();
    $vendedores = obtenerInformacion(LISTADO_VENDEDORES, $conexion);

    foreach ($vendedores as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if ($email == $usuario->getEmail()) {
            return ['resultado' => 2];
        }
    }

    foreach ($vendedores as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if ($telefono == $vendedor->getTelefono()) {
            return ['resultado' => 3];
        }
    }

    return null;
}

//validar los datos al modificar un vendedor
function validarVendedorM($vendedor, $conexion, $usuario)
{
    $encriptacion = new Encriptacion();
    $vendedores = obtenerInformacion(LISTADO_VENDEDORES, $conexion);

    foreach ($vendedores as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if (($email == $usuario->getEmail()) && ($vendedor->getId() != $row['id'])) {
            return ['resultado' => 2];
        }
    }

    foreach ($vendedores as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if (($telefono == $vendedor->getTelefono()) && ($vendedor->getId() != $row['id'])) {
            return ['resultado' => 3];
        }
    }

    return null;
}

//validar los datos al guardar un cliente
function validarCliente($cliente, $conexion)
{
    $encriptacion = new Encriptacion();
    $clientes = obtenerInformacion(LISTADO_CLIENTES, $conexion);

    foreach ($clientes as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if ($email == $cliente->getEmail()) {
            return ['resultado' => 2];
        }
    }

    foreach ($clientes as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if ($telefono == $cliente->getTelefono()) {
            return ['resultado' => 3];
        }
    }

    return null;
}

//validar los datos al intentar modicar un cliente
function validarClienteModificar($cliente, $conexion, $id)
{
    $encriptacion = new Encriptacion();
    $clientes = obtenerInformacion(LISTADO_CLIENTES, $conexion);

    foreach ($clientes as $row) {
        $email = $encriptacion->desencriptar($row['email']);

        if (($email == $cliente->getEmail()) && ($id != $row['id'])) {
            return ['resultado' => 2];
        }
    }

    foreach ($clientes as $row) {
        $telefono = $encriptacion->desencriptar($row['telefono']);

        if (($telefono == $cliente->getTelefono()) && ($id != $row['id'])) {
            return ['resultado' => 3];
        }
    }

    return null;
}
