<?php

//SQL para obtener todos los clientes
define('LISTADO_CLIENTES', 'SELECT * FROM clientes ORDER BY id DESC');

//SQL para almcenar un cliente
define('NUEVO_CLIENTE', 'INSERT INTO clientes(nombre, apellido, telefono, email, direccion) VALUES(:nombre, :apellido, :telefono, :email, :direccion)');

//SQL para modificar un cliente
define('MODIFICAR_CLIENTE', 'UPDATE clientes SET nombre = :nombre, apellido = :apellido, telefono = :telefono, email = :email, direccion = :direccion WHERE id = :id');

//SQL para eliminar un cliente
define('ELIMINAR_CLIENTE', 'DELETE FROM clientes WHERE id = :id');

//SQL para obtener un cliente
define('SELECCIONAR_CLIENTE', 'SELECT * FROM clientes WHERE id = :id');

//consulta que lista la cantidad de compras que a realizado el cliente
define("CLIENTE_VENTAS", 'SELECT c.nombre, COUNT(v.cliente) AS cantidad FROM ventas v
INNER JOIN clientes c
ON c.id=v.cliente
GROUP BY c.nombre
ORDER BY COUNT(v.cliente) DESC');

//consulta que me permite obtener la cantidad de registros
define('CANTIDAD_REGISTROS', 'SELECT COUNT(c.id) AS cliente,
(SELECT COUNT(p.id) FROM productos p) AS producto,
(SELECT COUNT(v.id) FROM ventas v) AS ventas,
(SELECT COUNT(c.id) FROM compras c) AS compras
FROM clientes c');
