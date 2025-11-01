<?php 

define('OBTENER_USUARIOS', 'SELECT u.id, u.email, u.password, u.vendedor, u.rol FROM usuarios u
INNER JOIN vendedores v 
ON v.id = u.vendedor
WHERE v.estado <> 0');

//permite cambiar la contraseña del usuario
define('CAMBIAR_PASSWORD', 'UPDATE usuarios SET password = :password WHERE id = :id');