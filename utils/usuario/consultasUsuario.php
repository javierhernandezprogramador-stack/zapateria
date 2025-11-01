<?php 

//SQL para verificar el correo
define('VERIFICAR_USUARIO_CORREO', 'SELECT id FROM usuarios WHERE email = :dato');

//SQL para almacenar un usuario
define('NUEVO_USUARIO', 'INSERT INTO usuarios(email, password, vendedor, rol) VALUES(:email, :password, :vendedor, :rol)');

//SQL para modificar correo
define('MODIFICAR_USUARIO_CORREO', 'UPDATE usuarios SET email = :email WHERE vendedor = :vendedor');

//SQL para eliminar un usuario
define('ELIMINAR_USUARIO', 'DELETE FROM usuarios WHERE vendedor = :id');

//SQL para verificar si existe el correo en un usuario diferente al seleccionado
define('VERIFICAR_USUARIO_CORREO_M', 'SELECT id FROM usuarios WHERE email = :dato AND vendedor <> :id');