<?php

$id = null;
$obj = null;

$input = file_get_contents("php://input");

//verificamos si hay una petición, si lo hubiese la obtenemos
if ($input != null) {
    $obj = json_decode($input);
}

//verificamos si existe una operacion
if (!isset($obj->op)) {
    http_response_code(400);
    echo json_encode(['error' => 'operacion no especificada']);
    exit;
}

$id = $obj->code;
$operacion = $obj->op;

validarOperacion($operacion, $obj, $id);


function validarOperacion($operacion, $obj, $id)
{
    require_once __DIR__ . '/../route.php';

    include ROOT_PATH . '/utils/vendedor/consultasVendedor.php';
    include ROOT_PATH . '/utils/usuario/consultasUsuario.php';
    include ROOT_PATH . '/utils/encriptacion.php';
    include ROOT_PATH . '/models/DaoVendedor.php';
    include ROOT_PATH . '/models/DaoUsuario.php';
    require ROOT_PATH . '/config/Conexion.php';
    include ROOT_PATH . '/utils/validar.php';

    $dao = new DaoVendedor();
    $daoUsuario = new DaoUsuario();

    switch ($operacion) {
        case 'registrar':
            $vendedor = $obj->vendedor;
            $respuesta = $dao->save($vendedor);
            if ($respuesta['resultado'] != 1) {
                echo json_encode($respuesta);
                break;
            }

            $email = $vendedor->email;
            $respuesta = $daoUsuario->save($email);
            echo json_encode($respuesta);

            break;
        case 'modificar':
            echo json_encode($dao->update($obj->vendedor, $id));
            break;
        case 'eliminar':
            echo json_encode($dao->delete($id));
            break;
        case 'restaurar':
            echo json_encode($dao->restaurar($id));
            break;
        case 'seleccionar':
            echo json_encode($dao->findById($id));
            break;
        case 'listarTodos':
            echo json_encode($dao->read());
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
