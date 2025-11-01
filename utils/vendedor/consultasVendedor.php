<?php

//SQL para obtener todos los vendedores
define('LISTADO_VENDEDORES', 'SELECT v.id, v.nombre, v.apellido, v.telefono, u.email, v.direccion, v.estado FROM vendedores v
INNER JOIN usuarios u 
ON u.vendedor = v.id
WHERE u.rol <> 1
ORDER BY v.id DESC');

//SQL para almacenar un vendedor
define('NUEVO_VENDEDOR', 'INSERT INTO vendedores(nombre, apellido, direccion, telefono, estado) VALUES(:nombre, :apellido, :direccion, :telefono, :estado)');

//SQL para modificar un vendedor
define('MODIFICAR_VENDEDOR', 'UPDATE vendedores SET nombre = :nombre, apellido = :apellido, direccion = :direccion, telefono = :telefono WHERE id = :id');

//SQL para eliminar un vendedor
define('ELIMINAR_VENDEDOR', 'UPDATE vendedores SET estado = 0 WHERE id = :id');

//SQL para restaurar un vendedor
define('RESTAURAR_VENDEDOR', 'UPDATE vendedores SET estado = 1 WHERE id = :id');

//SQL para obtener un vendedor
define('SELECCIONAR_VENDEDOR', 'SELECT v.id, v.nombre, v.apellido, v.telefono, u.email, v.direccion FROM vendedores v
INNER JOIN usuarios u 
ON u.vendedor = v.id 
WHERE v.id = :id');

//SQL para obtener ultimo vendedor
define('SELECCIONAR_ULTIMO_VENDEDOR', 'SELECT * FROM vendedores ORDER BY id DESC LIMIT 1');


//SQL para verificar si hay un teléfono existente
define('VENDEDOR_VERIFICAR_TELEFONO', 'SELECT id FROM vendedores WHERE telefono = :dato');

//SQL para verificar si existe el correo en un vendedor diferente al seleccionado
define('VERIFICAR_VENDEDOR_TELEFONO_M', 'SELECT id FROM vendedores WHERE telefono = :dato AND id <> :id');
