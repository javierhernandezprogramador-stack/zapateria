<?php

//SQL para obtener todas las ventas
define('LISTADO_VENTA', 'SELECT v.id, v.fecha_venta, c.nombre AS cliente, vn.nombre AS vendedor,  SUM(d.cantidad * d.precio) AS total
FROM ventas v
INNER JOIN clientes c ON c.id = v.cliente 
INNER JOIN vendedores vn ON vn.id = v.vendedor
INNER JOIN detalleventa d ON v.id = d.venta
GROUP BY v.id, v.fecha_venta, c.nombre, vn.nombre
ORDER BY v.id DESC');

//SQL para almacenar una venta
define('NUEVA_VENTA', 'INSERT INTO ventas(fecha_venta, cliente, vendedor) VALUES(:fecha, :cliente, :vendedor)');

//SQL para modificar una venta
define('MODIFICAR_VENTA', 'UPDATE ventas SET fecha_venta = :fecha, cliente = :cliente, vendedor = :vendedor WHERE id = :id');

//SQL para obtener una venta
define("SELECCIONAR_VENTA", 'SELECT * FROM ventas WHERE id = :id');

//SQL para obtener la venta que se ve en el modal
define('SELECCIONAR_VENTA_VER', 'SELECT v.id, v.fecha_venta, v.cliente, v.vendedor, c.nombre AS nombre_cliente, vn.nombre AS nombre_vendedor
FROM ventas v
INNER JOIN clientes c ON c.id = v.cliente
INNER JOIN vendedores vn ON vn.id = v.vendedor
WHERE v.id = :id');

//SQL para obtener la ultima compra
define('SELECCIONAR_ULTIMA_VENTA', 'SELECT * FROM ventas ORDER BY id DESC LIMIT 1');

//SQL que me permite obtener las ventas en el año
define('VENTAS_MES', 'SELECT MONTH(fecha_venta) AS mes, COUNT(id) AS cantidad 
FROM ventas
WHERE YEAR(fecha_venta) = YEAR(CURDATE())
GROUP BY MONTH(fecha_venta)');
