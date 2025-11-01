<?php 

//SQL para almcenar un detalle de compra
define('NUEVO_DETALLE_VENTA', 'INSERT INTO detalleventa(precio, cantidad, producto, venta) VALUES(:precio, :cantidad, :producto, :venta)');

//SQL para eliminar un detalle de venta
define('ELIMINAR_DETALLE_VENTA', 'DELETE FROM detalleventa WHERE id = :id');

//SQL para obtener un detalle de venta
define('SELECCIONAR_DETALLE_VENTA', 'SELECT d.id, d.precio, d.cantidad, p.nombre AS producto, d.venta FROM detalleventa d
INNER JOIN productos p ON d.producto = p.id
WHERE d.venta = :id');

//SQL que me permite obtener el id del producto de acuerdo al detalla de venta
define('OBTENER_PRODUCTO_DETALLE', 'SELECT producto, cantidad FROM detalleventa WHERE id = :id');
