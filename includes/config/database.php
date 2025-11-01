<?php 

//Retorna la instancia de la conexion de la base de datos
function conectarDB(): mysqli { 
    $hostName = 'localhost';
    $usuario = 'root';
    $password = 'root';
    $dbName = 'zapateria';

    $db = new mysqli($hostName, $usuario, $password, $dbName);

    if(!$db) {
        echo "Error al conectar la base de datos";
        exit;
    }

    return $db;
}

conectarDB();