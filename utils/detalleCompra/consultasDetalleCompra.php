<?php 

//SQL para obtener todos los detalles de compras
define('LISTADO_DETALLES', 'SELECT * FROM detallecompra ORDER BY id DESC');

//SQL para almcenar un detalle de compra
define('NUEVO_DETALLE', 'INSERT INTO detallecompra(precio, cantidad, producto, compra) VALUES(:precio, :cantidad, :producto, :compra)');

//SQL para modificar un proveedor
define('MODIFICAR_DETALLE', 'UPDATE proveedores SET nombre = :nombre, telefono = :telefono, email = :email, direccion = :direccion WHERE id = :id');

//SQL para eliminar un proveedor
define('ELIMINAR_DETALLE', 'DELETE FROM detallecompra WHERE id = :id');

//SQL para eliminar un detalle de acuero a una compra
define('ELIMINAR_DETALLE_COMPRA', 'DELETE FROM detallecompra WHERE compra = :id');

//SQL para obtener un detalle de compra
define('SELECCIONAR_DETALLE', 'SELECT d.id, d.precio, d.cantidad, p.nombre AS producto, d.compra FROM detallecompra d
INNER JOIN productos p ON d.producto = p.id
WHERE d.compra = :id');

//SQL que me permite obtener el id del producto de acuerdo al detalla de compra
define('OBTENER_PRODUCTO_DETALLE', 'SELECT producto, cantidad FROM detallecompra WHERE id = :id');
