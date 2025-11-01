<?php

//SQL para obtener todas las categorias
define('LISTADO_CATEGORIAS', 'SELECT * FROM categorias ORDER BY id DESC');

//SQL para almacenar una categoria
define('NUEVA_CATEGORIA', 'INSERT INTO categorias(nombre) VALUES(:nombre)');

//SQL para modificar una categoria
define('MODIFICAR_CATEGORIA', 'UPDATE categorias SET nombre = :nombre WHERE id = :id');

//SQL para eliminar una categoria
define('ELIMINAR_CATEGORIA', 'DELETE FROM categorias WHERE id = :id');

//SQL para obtener una categoria
define('SELECCIONAR_CATEGORIA', 'SELECT * FROM categorias WHERE id = :id');

//obtener la cantidad de categorias de acuerdo al producto
define('CANTIDAD_CATEGORIA', 'SELECT c.nombre, COUNT(p.id) AS cantidad FROM productos p
INNER JOIN categorias c 
ON p.categoria = c.id
GROUP BY p.categoria');
