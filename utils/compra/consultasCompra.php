<?php 

//SQL para obtener todas las compras
define('LISTADO_COMPRA', 'SELECT c.id, c.fecha_compra, p.nombre AS proveedor, v.nombre AS vendedor,  SUM(d.cantidad * d.precio) AS total
FROM compras c
INNER JOIN proveedores p ON c.proveedor = p.id 
INNER JOIN vendedores v ON v.id = c.vendedor
INNER JOIN detallecompra d ON d.compra = c.id
GROUP BY c.id, c.fecha_compra, p.nombre, v.nombre
ORDER BY c.id DESC');

//SQL para almacenar una compra
define('NUEVA_COMPRA', 'INSERT INTO compras(fecha_compra, proveedor, vendedor) VALUES(:fecha, :proveedor, :vendedor)');

//SQL para modificar una compra
define('MODIFICAR_COMPRA', 'UPDATE compras SET fecha_compra = :fecha, proveedor = :proveedor, vendedor = :vendedor WHERE id = :id');

//SQL para eliminar una compra
define('ELIMINAR_COMPRA', 'DELETE FROM compras WHERE id = :id');

//SQL para obtener una compra
define("SELECCIONAR_COMPRA", 'SELECT * FROM compras WHERE id = :id');

define('SELECCIONAR_COMPRA_VER', 'SELECT c.id, c.fecha_compra, c.proveedor, c.vendedor, p.nombre AS nombre_proveedor, v.nombre AS nombre_vendedor
FROM compras c
INNER JOIN proveedores p ON p.id = c.proveedor
INNER JOIN vendedores v ON v.id = c.vendedor
WHERE c.id = :id');

//SQL para obtener la ultima compra
define('SELECCIONAR_ULTIMA_COMPRA', 'SELECT * FROM compras ORDER BY id DESC LIMIT 1');

//SQL para obtener el flujo de efectivo
define('FLUJO_EFECTIVO', 'SELECT SUM(dc.cantidad*dc.precio) AS total_compra,
(SELECT SUM(dv.cantidad*dv.precio) FROM detalleventa dv) AS total_venta
FROM detallecompra dc');

//consulta que me permite obtener las compras de cada mes del año en vigencia
define('COMPRAS_MES', 'SELECT MONTH(fecha_compra) AS mes, COUNT(id) AS cantidad 
FROM compras
WHERE YEAR(fecha_compra) = YEAR(CURDATE())
GROUP BY MONTH(fecha_compra)');