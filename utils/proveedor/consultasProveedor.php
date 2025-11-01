<?php 

//SQL para obtener todos los proveedores
define('LISTADO_PROVEEDORES', 'SELECT * FROM proveedores ORDER BY id DESC');

//SQL para almcenar un proveedor
define('NUEVO_PROVEEDOR', 'INSERT INTO proveedores(nombre, telefono, email, direccion) VALUES(:nombre, :telefono, :email, :direccion)');

//SQL para modificar un proveedor
define('MODIFICAR_PROVEEDOR', 'UPDATE proveedores SET nombre = :nombre, telefono = :telefono, email = :email, direccion = :direccion WHERE id = :id');

//SQL para eliminar un proveedor
define('ELIMINAR_PROVEEDOR', 'DELETE FROM proveedores WHERE id = :id');

//SQL para obtener un proveedor un proveedor
define('SELECCIONAR_PROVEEDOR', 'SELECT * FROM proveedores WHERE id = :id');

//SQL que me permite conocer la cantidad de compra que se a hecho a cada proveedor
define("CANTIDAD_COMPRA_PROVEEDOR", 'SELECT p.id, p.nombre, COUNT(c.proveedor) AS cantidad FROM proveedores p
INNER JOIN compras c
ON p.id = c.proveedor
GROUP BY p.id, p.nombre
ORDER BY COUNT(c.proveedor) DESC');
