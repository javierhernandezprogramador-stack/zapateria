<?php

//SQL para obtener todos los productos
define('LISTADO_PRODUCTO', 'SELECT p.id, p.nombre, c.nombre AS categoria, g.nombre AS genero, p.descripcion, p.foto, p.cantidad, p.precio
FROM productos p
INNER JOIN categorias c ON c.id = p.categoria
INNER JOIN generos g ON g.id = p.genero
ORDER BY p.id DESC');

//SQL para almacenar un producto
define('NUEVO_PRODUCTO', 'INSERT INTO productos(nombre, categoria, genero, descripcion, foto, cantidad, precio) VALUES(:nombre, :categoria, :genero, :descripcion, :foto, :cantidad, :precio)');

//SQL para modificar un producto
define('MODIFICAR_PRODUCTO', 'UPDATE productos SET nombre = :nombre, categoria = :categoria, genero = :genero, descripcion = :descripcion, foto = :foto WHERE id = :id');

//SQL para eliminar un producto
define('ELIMINAR_PRODUCTO', 'DELETE FROM productos WHERE id = :id');

//SQL para obtener un producto
define('SELECCIONAR_PRODUCTO', 'SELECT * FROM productos WHERE id = :id');

//SQL que me permite actualizar la cantidad de productos
define('PRODUCTOS_CANTIDAD', 'UPDATE productos SET cantidad = :cantidad WHERE id = :id');

//SQL que me permite obtener la cantida de producto
define('ULTIMA_CANTIDAD_PRODUCTO', 'SELECT cantidad FROM productos WHERE id = :id');

//SQL para sumar sumar el costo total y cantidad total de cada producto
define('PRODUCTOS_CANTIDAD_COSTO_TOTAL', 'SELECT 
producto, 
SUM(precio * cantidad) AS costo_total, 
SUM(cantidad) AS cantidad_total 
FROM 
detallecompra 
GROUP BY 
producto');

//SQL que me permite modificar el precio de cada producto
define('UPDATE_PRECIO_PRODUCTO', 'UPDATE productos SET precio = :precio WHERE id = :id');

//SQL para obtener todos los productos que tengan en inventario
define('LISTADO_PRODUCTOS_DISPONIBLES', 'SELECT * FROM productos WHERE cantidad > 0');

define('PRODUCTOS_CANTIDAD_REPORTE', 'SELECT id, nombre, foto, TRUNCATE(precio, 2) AS precio, cantidad, TRUNCATE((precio * cantidad), 2) AS total
FROM productos
ORDER BY cantidad DESC');

define('PRODUCTOS_CANTIDAD_NOMBRE', 'SELECT id, nombre, cantidad
FROM productos
ORDER BY cantidad DESC');

//consulta que me permite conocer cuales son los productos mas vendidos
define('PRODUCTOS_MAS_VENDIDOS', 'SELECT p.nombre AS producto, COUNT(d.producto) AS cantidad FROM detalleventa d 
INNER JOIN productos p 
ON p.id = d.producto
GROUP BY p.nombre
ORDER BY COUNT(d.producto) DESC');